<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Get date range from request or default to current month
        $startDate = request('start_date', Carbon::now()->startOfMonth());
        $endDate = request('end_date', Carbon::now()->endOfMonth());

        // Convert string dates to Carbon instances if needed
        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate);
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate);
        }

        // Revenue statistics
        $revenueStats = Booking::whereBetween('check_in_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->select(
                DB::raw('SUM(total_price) as total_revenue'),
                DB::raw('COUNT(*) as total_bookings'),
                DB::raw('AVG(total_price) as average_booking_value')
            )
            ->first();

        // Room occupancy statistics
        $roomStats = Room::withCount(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('check_in_date', [$startDate, $endDate])
                ->where('status', 'confirmed');
        }])->get();

        // Service usage statistics
        $serviceStats = Service::withCount(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('check_in_date', [$startDate, $endDate])
                ->where('status', 'confirmed');
        }])->get();

        // Booking status distribution
        $bookingStatus = Booking::whereBetween('check_in_date', [$startDate, $endDate])
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Monthly revenue trend
        $monthlyRevenue = Booking::whereBetween('check_in_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->select(
                DB::raw('DATE_FORMAT(check_in_date, "%Y-%m") as month'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.index', compact(
            'revenueStats',
            'roomStats',
            'serviceStats',
            'bookingStatus',
            'monthlyRevenue',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $bookings = Booking::with(['user', 'room', 'services'])
            ->whereBetween('check_in_date', [$startDate, $endDate])
            ->get();

        // Generate CSV content
        $headers = [
            'Booking ID',
            'Guest Name',
            'Room',
            'Check In',
            'Check Out',
            'Status',
            'Total Amount',
            'Services'
        ];

        $rows = $bookings->map(function ($booking) {
            return [
                $booking->id,
                $booking->user->name,
                $booking->room->name,
                $booking->check_in_date->format('Y-m-d'),
                $booking->check_out->format('Y-m-d'),
                $booking->status,
                $booking->total_amount,
                $booking->services->pluck('name')->implode(', ')
            ];
        });

        $filename = 'bookings_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, $filename);
    }
} 
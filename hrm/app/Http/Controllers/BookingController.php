<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('room')
            ->latest()
            ->get();
            
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string'
        ]);

        $room = Room::findOrFail($request->room_id);

        // Check if room is available for the selected dates
        $isAvailable = !Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date]);
            })
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Room is not available for the selected dates.');
        }

        // Calculate number of nights
        $checkIn = \Carbon\Carbon::parse($request->check_in_date);
        $checkOut = \Carbon\Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);

        // Calculate total price
        $totalPrice = $room->price * $nights;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'total_amount' => $totalPrice, // Set total_amount equal to total_price initially
            'special_requests' => $request->special_requests,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking request submitted successfully!');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function download(Booking $booking)
    {
        $this->authorize('view', $booking);
        
        $pdf = PDF::loadView('bookings.receipt', compact('booking'));
        
        return $pdf->download('booking-receipt-' . $booking->id . '.pdf');
    }
}

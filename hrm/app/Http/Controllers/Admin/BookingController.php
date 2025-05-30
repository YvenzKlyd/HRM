<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])
            ->latest()
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updatePaymentStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed'
        ]);

        $booking->update([
            'payment_status' => $request->payment_status,
            'paid_at' => $request->payment_status === 'paid' ? now() : null
        ]);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Payment status updated successfully.');
    }
}
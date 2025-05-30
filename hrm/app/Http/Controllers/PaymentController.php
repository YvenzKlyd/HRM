<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm(Booking $booking)
    {
        // Ensure the user can only view their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->isPaid()) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'This booking has already been paid.');
        }

        return view('payments.form', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        // Ensure the user can only pay for their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->isPaid()) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'This booking has already been paid.');
        }

        $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,cash'
        ]);

        // Here you would typically integrate with a payment gateway
        // For now, we'll just mark it as paid
        $booking->markAsPaid($request->payment_method);
        $booking->update(['status' => 'confirmed']);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Payment processed successfully! Your booking is now confirmed.');
    }
}
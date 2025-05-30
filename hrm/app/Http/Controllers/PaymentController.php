<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm(Booking $booking)
    {
        if ($booking->isPaid()) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'This booking has already been paid.');
        }

        return view('payments.form', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,cash'
        ]);

        // Here you would typically integrate with a payment gateway
        // For now, we'll just mark it as paid
        $booking->markAsPaid($request->payment_method);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Payment processed successfully!');
    }
}
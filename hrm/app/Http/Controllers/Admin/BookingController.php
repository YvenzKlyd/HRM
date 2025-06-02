<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
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

    public function create()
    {
        $users = User::all();
        $rooms = Room::where('is_available', true)->get();
        return view('admin.bookings.create', compact('users', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled',
            'special_requests' => 'nullable|string'
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check if room is available for the selected dates
        $isAvailable = !Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in_date', [$validated['check_in_date'], $validated['check_out_date']])
                    ->orWhereBetween('check_out_date', [$validated['check_in_date'], $validated['check_out_date']]);
            })
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Room is not available for the selected dates.');
        }

        // Calculate number of nights and total price
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        $booking = Booking::create([
            'user_id' => $validated['user_id'],
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => $validated['status'],
            'special_requests' => $validated['special_requests']
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $rooms = Room::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'rooms'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled',
            'special_requests' => 'nullable|string'
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check if room is available for the selected dates (excluding current booking)
        $isAvailable = !Booking::where('room_id', $room->id)
            ->where('id', '!=', $booking->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in_date', [$validated['check_in_date'], $validated['check_out_date']])
                    ->orWhereBetween('check_out_date', [$validated['check_in_date'], $validated['check_out_date']]);
            })
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Room is not available for the selected dates.');
        }

        // Calculate number of nights and total price
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        $booking->update([
            'user_id' => $validated['user_id'],
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => $validated['status'],
            'special_requests' => $validated['special_requests']
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
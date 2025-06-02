<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Determine if the given booking can be viewed by the user.
     */
    public function view(User $user, Booking $booking)
    {
        // Allow if the user owns the booking
        if ($user->id === $booking->user_id) {
            return true;
        }
        // Optionally, allow admin to view any booking
        if (property_exists($user, 'is_admin') && $user->is_admin) {
            return true;
        }
        return false;
    }
} 
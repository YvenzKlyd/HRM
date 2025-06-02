<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_service')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
} 
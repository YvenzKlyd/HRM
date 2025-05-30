<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method',
        'amount',
        'status',
        'transaction_id',
        'payment_details',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_details' => 'array',
        'paid_at' => 'datetime'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function markAsCompleted(string $transactionId = null, array $details = []): void
    {
        $this->update([
            'status' => 'completed',
            'transaction_id' => $transactionId,
            'payment_details' => $details,
            'paid_at' => now()
        ]);

        // Update the booking status
        $this->booking->markAsPaid($this->payment_method);
    }

    public function markAsFailed(string $reason = null): void
    {
        $this->update([
            'status' => 'failed',
            'payment_details' => array_merge($this->payment_details ?? [], ['failure_reason' => $reason])
        ]);
    }
}

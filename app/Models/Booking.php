<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'guest_name',
        'guest_whatsapp',
        'booking_time',
        'number_of_guests',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'booking_time' => 'datetime',
        ];
    }

    /**
     * The wisatawan who made this booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The restaurant this booking is for.
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}

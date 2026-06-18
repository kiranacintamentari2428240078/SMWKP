<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nama_restoran',
        'email',
        'whatsapp',
        'kategori',
        'alamat',
        'photos',
        'nib_number',
        'halal_certificate_number',
        'status',
        'rejection_reason',
        'halal_status',
        'maps_url',
        'latitude',
        'longitude',
        'description',
        'nib_file',
        'halal_certificate_file',
        'operational_hours',
    ];

    protected function casts(): array
    {
        return [
            'photos' => 'array',
        ];
    }

    /**
     * The owner (mitra) of this restaurant.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bookings made at this restaurant.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Reviews written for this restaurant.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Menus available at this restaurant.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the first photo from the photos JSON array.
     */
    public function getPhotoAttribute()
    {
        if (is_array($this->photos) && count($this->photos) > 0) {
            return $this->photos[0];
        }
        return null;
    }

    /**
     * Get the resolved URL for the restaurant's primary photo.
     */
    public function getPhotoUrlAttribute()
    {
        $photo = $this->photo;
        if (!$photo) {
            return 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800';
        }
        if (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')) {
            return $photo;
        }
        return asset('storage/' . $photo);
    }

    /**
     * Get the resolved URLs for all photos.
     */
    public function getResolvedPhotosAttribute(): array
    {
        if (!is_array($this->photos) || count($this->photos) === 0) {
            return ['https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800'];
        }
        return array_map(function ($photo) {
            if (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')) {
                return $photo;
            }
            return asset('storage/' . $photo);
        }, $this->photos);
    }

    /**
     * Check if the restaurant can be edited (only in draft or rejected state).
     */
    public function isEditable(): bool
    {
        return in_array($this->status, ['draft', 'rejected']);
    }

    /**
     * Check if the restaurant can be submitted for verification.
     */
    public function canSubmit(): bool
    {
        return in_array($this->status, ['draft', 'rejected']);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ─── Relationships ───────────────────────────────────────

    /**
     * The restaurant owned by this user (mitra role).
     */
    public function restaurant(): HasOne
    {
        return $this->hasOne(Restaurant::class);
    }

    /**
     * Bookings made by this user (wisatawan role).
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Reviews written by this user (wisatawan role).
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // ─── Role Helpers ────────────────────────────────────────

    public function isWisatawan(): bool
    {
        return $this->role === 'wisatawan';
    }

    public function isMitra(): bool
    {
        return $this->role === 'mitra';
    }

    public function isAdminDinas(): bool
    {
        return $this->role === 'admin_dinas';
    }

    /**
     * Get resolved profile photo URL.
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
                return $this->photo;
            }
            return asset('storage/' . $this->photo);
        }
        
        // Return a generic profile initials avatar or placeholder
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=5a0f16&color=d1c7b7&size=128';
    }
}

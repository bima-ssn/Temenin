<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraProfile extends Model
{
    protected $fillable = [
        'user_id',
        'tagline',
        'city',
        'photo_path',
        'description',
        'rate_per_hour',
        'experience_years',
        'interests',
        'available_days',
        'available_time_slots',
        'social_links',
        'status',
        'approved_at',
        'approved_by',
        'rating_average',
        'reviews_count',
    ];

    protected $casts = [
        'interests' => 'array',
        'available_days' => 'array',
        'available_time_slots' => 'array',
        'social_links' => 'array',
        'approved_at' => 'datetime',
        'rate_per_hour' => 'decimal:2',
        'rating_average' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'mitra_profile_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'mitra_id');
    }
}

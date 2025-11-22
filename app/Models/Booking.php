<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'customer_id',
        'mitra_id',
        'mitra_profile_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'duration_hours',
        'price',
        'status',
        'meeting_type',
        'location',
        'notes',
        'payment_status',
        'payment_due_at',
        'chat_opened_at',
        'approved_at',
        'rejected_at',
        'cancelled_at',
        'completed_at',
        'rejection_reason',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'payment_due_at' => 'datetime',
        'chat_opened_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function mitraProfile()
    {
        return $this->belongsTo(MitraProfile::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopeForCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeForMitra($query, $mitraId)
    {
        return $query->where('mitra_id', $mitraId);
    }
}

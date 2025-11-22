<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'booking_id',
        'sender_id',
        'receiver_id',
        'message',
        'attachment_path',
        'is_system',
        'delivered_at',
        'read_at',
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'delivered_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

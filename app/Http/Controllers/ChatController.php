<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ChatMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(Booking $booking): View
    {
        $this->authorizeParticipant($booking);

        abort_if(is_null($booking->chat_opened_at), 403, 'Chat akan aktif setelah pembayaran selesai.');

        $messages = $booking->chatMessages()
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        return view('chat.show', compact('booking', 'messages'));
    }

    public function store(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorizeParticipant($booking);
        abort_if(is_null($booking->chat_opened_at), 403, 'Chat belum dibuka.');

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        ChatMessage::create([
            'booking_id' => $booking->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $booking->customer_id === auth()->id() ? $booking->mitra_id : $booking->customer_id,
            'message' => $request->message,
        ]);

        return back();
    }

    private function authorizeParticipant(Booking $booking): void
    {
        abort_unless(in_array(auth()->id(), [$booking->customer_id, $booking->mitra_id], true), 403);
    }
}

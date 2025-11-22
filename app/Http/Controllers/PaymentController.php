<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(Booking $booking): View
    {
        $this->authorizeCustomer($booking);
        return view('customer.payment', compact('booking'));
    }

    public function store(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorizeCustomer($booking);

        if ($booking->status !== 'awaiting_payment') {
            return back()->withErrors(['payment' => 'Pembayaran hanya tersedia setelah Mitra menyetujui booking.']);
        }

        $request->validate([
            'method' => ['required', 'in:bank_transfer,ewallet,cash'],
        ]);

        Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'amount' => $booking->price,
                'method' => $request->method,
                'status' => 'paid',
                'transaction_reference' => $booking->booking_code.'-'.Str::upper(Str::random(6)),
                'paid_at' => now(),
                'provider' => $request->method === 'bank_transfer' ? 'BCA Virtual Account' : 'TemanIn Pay',
            ]
        );

        $booking->update([
            'status' => 'paid',
            'payment_status' => 'paid',
            'chat_opened_at' => now(),
        ]);

        return redirect()->route('customer.dashboard')->with('status', 'Pembayaran berhasil. Chat dengan Mitra sudah dibuka!');
    }

    private function authorizeCustomer(Booking $booking): void
    {
        abort_unless($booking->customer_id === auth()->id(), 403);
    }
}

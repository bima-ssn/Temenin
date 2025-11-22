<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MitraProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request, MitraProfile $profile): RedirectResponse
    {
        if ($profile->status !== 'approved') {
            return back()->withErrors(['profile' => 'Mitra belum aktif.']);
        }

        $request->validate([
            'scheduled_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_hours' => ['required', 'integer', 'min:1', 'max:8'],
            'meeting_type' => ['required', 'in:online,offline'],
            'location' => ['required_if:meeting_type,offline', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $price = $profile->rate_per_hour * $request->duration_hours;

        Booking::create([
            'booking_code' => Str::uuid(),
            'customer_id' => auth()->id(),
            'mitra_id' => $profile->user_id,
            'mitra_profile_id' => $profile->id,
            'scheduled_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => now()->setTimeFromTimeString($request->start_time)->addHours($request->duration_hours)->format('H:i'),
            'duration_hours' => $request->duration_hours,
            'price' => $price,
            'meeting_type' => $request->meeting_type,
            'location' => $request->meeting_type === 'offline' ? $request->location : null,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('customer.dashboard')->with('status', 'Booking berhasil dibuat. Menunggu persetujuan Mitra.');
    }

    public function approve(Booking $booking): RedirectResponse
    {
        $this->authorizeAction($booking, ['mitra']);

        $booking->update([
            'status' => 'awaiting_payment',
            'payment_status' => 'pending',
            'approved_at' => now(),
            'payment_due_at' => now()->addDay(),
        ]);

        return back()->with('status', 'Booking disetujui. Menunggu pembayaran Customer.');
    }

    public function reject(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorizeAction($booking, ['mitra']);

        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason,
            'rejected_at' => now(),
        ]);

        return back()->with('status', 'Booking berhasil ditolak.');
    }

    public function complete(Booking $booking): RedirectResponse
    {
        $this->authorizeAction($booking, ['mitra', 'admin']);

        $booking->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('status', 'Booking ditandai selesai.');
    }

    private function authorizeAction(Booking $booking, array $actors): void
    {
        $user = auth()->user();

        $isAllowed = collect($actors)->contains(function ($actor) use ($user, $booking) {
            return match ($actor) {
                'mitra' => $user?->id === $booking->mitra_id,
                'customer' => $user?->id === $booking->customer_id,
                'admin' => $user?->isAdmin(),
                default => false,
            };
        });

        abort_unless($isAllowed, 403);
    }
}

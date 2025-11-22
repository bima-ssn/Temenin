<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MitraProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MitraController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user();
        $profile = $user->mitraProfile;

        $stats = [
            'pending' => $user->mitraBookings()->where('status', 'pending')->count(),
            'approved' => $user->mitraBookings()->where('status', 'approved')->count(),
            'completed' => $user->mitraBookings()->where('status', 'completed')->count(),
            'rating' => $profile?->rating_average ?? 0,
        ];

        $recentBookings = $user->mitraBookings()
            ->with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('mitra.dashboard', compact('stats', 'profile', 'recentBookings'));
    }

    public function bookings(): View
    {
        $bookings = Booking::query()
            ->with(['customer', 'payment'])
            ->where('mitra_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('mitra.bookings', compact('bookings'));
    }

    public function approval(): View
    {
        $profile = auth()->user()->mitraProfile;
        return view('mitra.approval', compact('profile'));
    }

    public function profile(): View
    {
        $profile = auth()->user()->mitraProfile;
        return view('mitra.profile', compact('profile'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'tagline' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'rate_per_hour' => ['required', 'numeric', 'min:50000'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:50'],
            'interests' => ['nullable', 'string'],
            'available_days' => ['nullable', 'array'],
            'available_days.*' => ['string'],
            'available_time_slots' => ['nullable', 'string'],
        ]);

        $profile = auth()->user()->mitraProfile ?? new MitraProfile(['user_id' => auth()->id()]);

        $profile->fill([
            'tagline' => $request->tagline,
            'description' => $request->description,
            'city' => $request->city,
            'rate_per_hour' => $request->rate_per_hour,
            'experience_years' => $request->experience_years,
            'interests' => $this->splitByComma($request->interests),
            'available_days' => $request->available_days,
            'available_time_slots' => $this->splitByComma($request->available_time_slots),
            'status' => $profile->status === 'approved' ? 'approved' : 'pending',
        ]);

        $profile->save();

        return back()->with('status', 'Profil Mitra berhasil diperbarui. Menunggu verifikasi Admin.');
    }

    private function splitByComma(?string $value): ?array
    {
        if (! $value) {
            return null;
        }

        return collect(explode(',', $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}

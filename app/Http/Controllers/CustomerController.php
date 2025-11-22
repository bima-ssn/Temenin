<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MitraProfile;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function landing(): View
    {
        $topMitra = MitraProfile::query()
            ->with('user')
            ->where('status', 'approved')
            ->orderByDesc('rating_average')
            ->take(6)
            ->get();

        return view('welcome', compact('topMitra'));
    }

    public function redirectToRoleDashboard(): RedirectResponse
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isMitra()) {
            return redirect()->route('mitra.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    public function dashboard(): View
    {
        $upcomingBookings = Booking::query()
            ->with('mitra')
            ->where('customer_id', auth()->id())
            ->orderBy('scheduled_date')
            ->limit(5)
            ->get();

        $history = Booking::query()
            ->with('mitra')
            ->where('customer_id', auth()->id())
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact('upcomingBookings', 'history'));
    }

    public function mitraIndex(Request $request): View
    {
        $query = MitraProfile::query()->with('user')->where('status', 'approved');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('tagline', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhereJsonContains('interests', $search);
            });
        }

        $mitra = $query->paginate(9)->withQueryString();

        return view('customer.mitra-index', compact('mitra'));
    }

    public function mitraShow(MitraProfile $profile): View
    {
        $reviews = Review::query()
            ->with('customer')
            ->where('mitra_id', $profile->user_id)
            ->latest()
            ->get();

        return view('customer.mitra-show', compact('profile', 'reviews'));
    }

    public function bookingForm(MitraProfile $profile): View
    {
        $profile->load('user');
        return view('customer.booking-create', compact('profile'));
    }

    public function storeReview(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        if ($booking->customer_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        $review = Review::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'customer_id' => auth()->id(),
                'mitra_id' => $booking->mitra_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'published_at' => now(),
            ]
        );

        $profile = $booking->mitraProfile;
        if ($profile) {
            $profile->update([
                'reviews_count' => Review::where('mitra_id', $profile->user_id)->count(),
                'rating_average' => Review::where('mitra_id', $profile->user_id)->avg('rating') ?? 0,
            ]);
        }

        return back()->with('status', 'Terima kasih atas review-nya!');
    }
}

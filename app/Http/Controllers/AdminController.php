<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MitraProfile;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'customers' => User::query()->whereRelation('role', 'name', Role::CUSTOMER)->count(),
            'mitra' => User::query()->whereRelation('role', 'name', Role::MITRA)->count(),
            'pending_mitra' => MitraProfile::query()->where('status', 'pending')->count(),
            'bookings' => Booking::query()->count(),
            'transactions' => Payment::query()->where('status', 'paid')->count(),
            'revenue' => Payment::query()->where('status', 'paid')->sum('amount'),
        ];

        $recentBookings = Booking::query()
            ->with(['customer', 'mitra'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function approvals(): View
    {
        $pendingMitra = MitraProfile::query()
            ->with('user')
            ->where('status', 'pending')
            ->paginate(10);

        return view('admin.approvals', compact('pendingMitra'));
    }

    public function approveMitra(MitraProfile $profile): RedirectResponse
    {
        $profile->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        $profile->user->update(['status' => 'active']);

        return back()->with('status', 'Mitra '.$profile->user->name.' telah disetujui.');
    }

    public function rejectMitra(Request $request, MitraProfile $profile): RedirectResponse
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $profile->update([
            'status' => 'rejected',
            'approved_at' => null,
            'approved_by' => null,
            'description' => $profile->description.PHP_EOL.'Catatan Admin: '.$request->reason,
        ]);

        $profile->user->update(['status' => 'inactive']);

        return back()->with('status', 'Mitra '.$profile->user->name.' ditolak.');
    }

    public function customers(): View
    {
        $customers = User::query()
            ->withCount('customerBookings')
            ->whereRelation('role', 'name', Role::CUSTOMER)
            ->paginate(12);

        return view('admin.customers', compact('customers'));
    }

    public function mitra(): View
    {
        $mitra = User::query()
            ->with(['mitraProfile'])
            ->whereRelation('role', 'name', Role::MITRA)
            ->paginate(12);

        return view('admin.mitra', compact('mitra'));
    }

    public function bookings(): View
    {
        $bookings = Booking::query()
            ->with(['customer', 'mitra', 'payment'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }
}

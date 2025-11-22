<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MitraMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role?->name !== Role::MITRA) {
            abort(403, 'Hanya Mitra yang dapat mengakses halaman ini.');
        }

        if ($user->mitraProfile?->status === 'pending') {
            session()->flash('status-warning', 'Menunggu persetujuan admin sebelum dapat menerima booking.');
        }

        return $next($request);
    }
}

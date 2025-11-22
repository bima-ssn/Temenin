<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role?->name !== Role::CUSTOMER) {
            abort(403, 'Hanya Customer yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}

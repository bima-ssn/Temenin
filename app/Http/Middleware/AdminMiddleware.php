<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->role?->name) {
            return redirect()->route('login');
        }

        if ($request->user()->role->name !== Role::ADMIN) {
            abort(403, 'Anda tidak memiliki akses Admin.');
        }

        return $next($request);
    }
}

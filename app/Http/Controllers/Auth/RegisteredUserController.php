<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MitraProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', Rule::in(Role::CUSTOMER, Role::MITRA)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = Role::query()->where('name', $request->role)->firstOrFail();

        $user = User::create([
            'role_id' => $role->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'bio' => $request->bio,
            'status' => $request->role === Role::MITRA ? 'inactive' : 'active',
            'password' => Hash::make($request->password),
        ]);

        if ($role->name === Role::MITRA) {
            MitraProfile::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'tagline' => 'Teman ngobrol baru siap menemani.',
                'description' => $request->bio,
                'rate_per_hour' => 75000,
                'available_days' => ['senin', 'selasa', 'rabu'],
                'available_time_slots' => ['18:00 - 21:00'],
                'interests' => ['musik', 'kuliner'],
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}

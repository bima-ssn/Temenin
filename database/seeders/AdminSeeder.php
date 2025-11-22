<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = Role::query()->where('name', Role::ADMIN)->value('id');

        if (! $adminRoleId) {
            $this->call(RoleSeeder::class);
            $adminRoleId = Role::query()->where('name', Role::ADMIN)->value('id');
        }

        User::query()->updateOrCreate(
            ['email' => 'admin@temanin.test'],
            [
                'role_id' => $adminRoleId,
                'name' => 'Super Admin TemanIn',
                'phone' => '0800000000',
                'city' => 'Yogyakarta',
                'bio' => 'Admin default sistem TemanIn. Silakan ganti credential ini di produksi.',
                'status' => 'active',
                'password' => Hash::make('password'),
            ]
        );
    }
}

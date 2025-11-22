<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => Role::ADMIN,
                'display_name' => 'Administrator',
                'description' => 'Mengelola seluruh aktivitas sistem TemanIn.',
            ],
            [
                'name' => Role::MITRA,
                'display_name' => 'Mitra Teman',
                'description' => 'Pendamping profesional yang menerima booking.',
            ],
            [
                'name' => Role::CUSTOMER,
                'display_name' => 'Customer',
                'description' => 'Pengguna yang memesan layanan teman ngobrol.',
            ],
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(
                ['name' => $role['name']],
                [
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}

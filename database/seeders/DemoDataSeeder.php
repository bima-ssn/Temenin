<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\ChatMessage;
use App\Models\MitraProfile;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $faker = fake();
            $roles = Role::query()
                ->pluck('id', 'name')
                ->whenEmpty(function () {
                    $this->call(RoleSeeder::class);

                    return Role::query()->pluck('id', 'name');
                });

            $customers = collect([
                [
                    'name' => 'Alya Customer',
                    'email' => 'customer1@temanin.test',
                    'city' => 'Jakarta',
                ],
                [
                    'name' => 'Bimo Customer',
                    'email' => 'customer2@temanin.test',
                    'city' => 'Bandung',
                ],
            ])->map(function (array $data) use ($roles, $faker) {
                return User::query()->updateOrCreate(
                    ['email' => $data['email']],
                    [
                        'role_id' => $roles[Role::CUSTOMER],
                        'name' => $data['name'],
                        'phone' => $faker->phoneNumber(),
                        'city' => $data['city'],
                        'bio' => 'Customer demo TemanIn.',
                        'status' => 'active',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                    ]
                );
            });

            $mitra = collect([
                [
                    'name' => 'Rani Teman Curhat',
                    'email' => 'mitra1@temanin.test',
                    'tagline' => 'Konselor karier & self-healing',
                    'city' => 'Yogyakarta',
                    'rate' => 125_000,
                    'interests' => ['karier', 'self-improvement', 'healing'],
                    'days' => ['senin', 'rabu', 'jumat'],
                    'slots' => ['09:00 - 12:00', '19:00 - 21:00'],
                ],
                [
                    'name' => 'Dimas Teman Diskusi',
                    'email' => 'mitra2@temanin.test',
                    'tagline' => 'Teman diskusi startup & produktivitas',
                    'city' => 'Surabaya',
                    'rate' => 95_000,
                    'interests' => ['startup', 'investasi', 'teknologi'],
                    'days' => ['selasa', 'kamis', 'sabtu'],
                    'slots' => ['10:00 - 13:00', '20:00 - 23:00'],
                ],
            ])->map(function (array $data) use ($roles, $faker) {
                $user = User::query()->updateOrCreate(
                    ['email' => $data['email']],
                    [
                        'role_id' => $roles[Role::MITRA],
                        'name' => $data['name'],
                        'phone' => $faker->phoneNumber(),
                        'city' => $data['city'],
                        'bio' => $data['tagline'],
                        'status' => 'active',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                    ]
                );

                $profile = MitraProfile::query()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'tagline' => $data['tagline'],
                        'city' => $data['city'],
                        'description' => 'Profil demo untuk '.$data['name'],
                        'rate_per_hour' => $data['rate'],
                        'experience_years' => 3,
                        'interests' => $data['interests'],
                        'available_days' => $data['days'],
                        'available_time_slots' => $data['slots'],
                        'status' => 'approved',
                        'approved_at' => now()->subDays(3),
                        'approved_by' => User::query()->whereRelation('role', 'name', Role::ADMIN)->value('id'),
                        'rating_average' => 4.9,
                        'reviews_count' => 0,
                    ]
                );

                return [$user, $profile];
            });

            Booking::query()->updateOrCreate(
                ['booking_code' => 'DEMO-PAID'],
                [
                    'customer_id' => $customers->first()->id,
                    'mitra_id' => $mitra[0][0]->id,
                    'mitra_profile_id' => $mitra[0][1]->id,
                    'scheduled_date' => now()->addDays(2)->toDateString(),
                    'start_time' => '19:00',
                    'end_time' => '21:00',
                    'duration_hours' => 2,
                    'price' => 250000,
                    'status' => 'awaiting_payment',
                    'meeting_type' => 'online',
                    'notes' => 'Sesi konsultasi demo',
                    'payment_status' => 'pending',
                    'booking_code' => 'DEMO-PAID',
                ]
            );

            $bookingCompleted = Booking::query()->updateOrCreate(
                ['booking_code' => 'DEMO-DONE'],
                [
                    'customer_id' => $customers->last()->id,
                    'mitra_id' => $mitra[1][0]->id,
                    'mitra_profile_id' => $mitra[1][1]->id,
                    'scheduled_date' => now()->subDays(3)->toDateString(),
                    'start_time' => '10:00',
                    'end_time' => '12:00',
                    'duration_hours' => 2,
                    'price' => 190000,
                    'status' => 'completed',
                    'meeting_type' => 'offline',
                    'location' => 'Cafe TemanIn, Surabaya',
                    'notes' => 'Diskusi studi kasus startup',
                    'payment_status' => 'paid',
                    'approved_at' => now()->subDays(4),
                    'payment_due_at' => now()->subDays(4)->addHours(6),
                    'chat_opened_at' => now()->subDays(3)->subHours(6),
                    'completed_at' => now()->subDays(3)->addHours(2),
                ]
            );

            Payment::query()->updateOrCreate(
                ['booking_id' => $bookingCompleted->id],
                [
                    'amount' => $bookingCompleted->price,
                    'status' => 'paid',
                    'method' => 'bank_transfer',
                    'provider' => 'BCA Virtual Account',
                    'transaction_reference' => 'PAY-'.$bookingCompleted->booking_code,
                    'paid_at' => now()->subDays(3)->subHours(5),
                ]
            );

            ChatMessage::query()->firstOrCreate(
                [
                    'booking_id' => $bookingCompleted->id,
                    'sender_id' => $bookingCompleted->customer_id,
                    'receiver_id' => $bookingCompleted->mitra_id,
                    'message' => 'Halo Kak, siap untuk sesi besok?',
                ]
            );

            ChatMessage::query()->firstOrCreate(
                [
                    'booking_id' => $bookingCompleted->id,
                    'sender_id' => $bookingCompleted->mitra_id,
                    'receiver_id' => $bookingCompleted->customer_id,
                    'message' => 'Siap! Sampai jumpa besok di lokasi ya.',
                ]
            );

            Review::query()->updateOrCreate(
                ['booking_id' => $bookingCompleted->id],
                [
                    'customer_id' => $bookingCompleted->customer_id,
                    'mitra_id' => $bookingCompleted->mitra_id,
                    'rating' => 5,
                    'comment' => 'Sesi sangat membantu dan actionable!',
                    'published_at' => now()->subDays(2),
                ]
            );

            $mitra[1][1]->update([
                'reviews_count' => Review::where('mitra_id', $bookingCompleted->mitra_id)->count(),
                'rating_average' => Review::where('mitra_id', $bookingCompleted->mitra_id)->avg('rating'),
            ]);
        });
    }
}

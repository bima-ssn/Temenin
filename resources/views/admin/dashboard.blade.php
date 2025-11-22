<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dashboard Admin
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Pantau statistik utama TemanIn.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @php
                    $statCards = [
                        ['label' => 'Customer', 'value' => number_format($stats['customers'] ?? 0)],
                        ['label' => 'Mitra Aktif', 'value' => number_format($stats['mitra'] ?? 0)],
                        ['label' => 'Mitra Pending', 'value' => number_format($stats['pending_mitra'] ?? 0)],
                        ['label' => 'Total Booking', 'value' => number_format($stats['bookings'] ?? 0)],
                        ['label' => 'Transaksi Sukses', 'value' => number_format($stats['transactions'] ?? 0)],
                        ['label' => 'Total Pendapatan', 'value' => 'Rp'.number_format($stats['revenue'] ?? 0, 0, ',', '.')],
                    ];
                @endphp
                @foreach ($statCards as $card)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $card['label'] }}</p>
                        <p class="mt-3 text-3xl font-semibold text-gray-900 dark:text-white">{{ $card['value'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Booking terbaru</h3>
                    <a href="{{ route('admin.bookings') }}" class="text-sm text-indigo-600 hover:underline">Lihat semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/30">
                            <tr>
                                <th class="px-4 py-2 text-start font-medium text-gray-500">Kode</th>
                                <th class="px-4 py-2 text-start font-medium text-gray-500">Customer</th>
                                <th class="px-4 py-2 text-start font-medium text-gray-500">Mitra</th>
                                <th class="px-4 py-2 text-start font-medium text-gray-500">Jadwal</th>
                                <th class="px-4 py-2 text-start font-medium text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($recentBookings as $booking)
                                <tr>
                                    <td class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-100">{{ $booking->booking_code }}</td>
                                    <td class="px-4 py-3">{{ $booking->customer?->name }}</td>
                                    <td class="px-4 py-3">{{ $booking->mitra?->name }}</td>
                                    <td class="px-4 py-3">{{ $booking->scheduled_date->format('d M Y') }} {{ $booking->start_time }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada booking.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


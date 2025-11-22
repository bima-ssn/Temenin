<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Semua Booking
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Kode</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Customer</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Mitra</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Jadwal</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-4 py-3 font-semibold">{{ $booking->booking_code }}</td>
                                    <td class="px-4 py-3">{{ $booking->customer?->name }}</td>
                                    <td class="px-4 py-3">{{ $booking->mitra?->name }}</td>
                                    <td class="px-4 py-3">
                                        {{ $booking->scheduled_date->format('d M Y') }}<br>
                                        <span class="text-xs text-gray-500">{{ $booking->start_time }} WIB</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-full bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ ucfirst($booking->payment_status) }}
                                        @if ($booking->payment?->transaction_reference)
                                            <p class="text-xs text-gray-500">{{ $booking->payment->transaction_reference }}</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Halo, {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Selamat Datang di Dashboard Anda</h3>
                        <p class="opacity-90">Kelola booking dan lihat riwayat layanan Anda di sini</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <!-- Upcoming Bookings Card -->
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3 bg-indigo-100 p-2 rounded-lg dark:bg-indigo-900">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Booking Mendatang</h3>
                        </div>
                        <a href="{{ route('customer.mitra.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200 flex items-center">
                            Cari Mitra
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse ($upcomingBookings as $booking)
                            <div class="rounded-xl border border-gray-100 bg-white p-4 transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-750">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $booking->mitra?->name }}</p>
                                        <div class="flex items-center mt-1 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $booking->scheduled_date->format('d M Y') }} • {{ $booking->start_time }} WIB
                                        </div>
                                        <div class="mt-2 flex items-center">
                                            <span class="text-sm mr-2">Status:</span>
                                            @php
                                                $statusColors = [
                                                    'awaiting_payment' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                    'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                    'in_progress' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                ];
                                                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                            @endphp
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2 text-sm">
                                    @if ($booking->status === 'awaiting_payment')
                                        <a href="{{ route('customer.payments.show', $booking) }}" class="rounded-lg bg-indigo-600 px-3 py-2 text-white font-medium hover:bg-indigo-700 transition-colors duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            Bayar Sekarang
                                        </a>
                                    @endif
                                    @if ($booking->chat_opened_at)
                                        <a href="{{ route('customer.chat.show', $booking) }}" class="rounded-lg border border-indigo-200 px-3 py-2 text-indigo-600 font-medium hover:bg-indigo-50 transition-colors duration-200 flex items-center dark:border-indigo-700 dark:text-indigo-400 dark:hover:bg-indigo-900">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            Chat Mitra
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">Belum ada booking aktif.</p>
                                <a href="{{ route('customer.mitra.index') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-800 font-medium">
                                    Cari mitra sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- History Card -->
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 mr-3 bg-purple-100 p-2 rounded-lg dark:bg-purple-900">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Riwayat Terbaru</h3>
                    </div>
                    <div class="space-y-4">
                        @forelse ($history as $booking)
                            <div class="rounded-xl border border-gray-100 bg-white p-4 transition-all duration-200 hover:border-purple-200 hover:bg-purple-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-750">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $booking->mitra?->name }}</p>
                                        <div class="flex items-center mt-1 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $booking->scheduled_date->format('d M Y') }}
                                        </div>
                                        <div class="mt-2 flex items-center">
                                            <span class="text-sm mr-2">Status:</span>
                                            @php
                                                $statusColors = [
                                                    'awaiting_payment' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                    'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                    'in_progress' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                ];
                                                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                            @endphp
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if ($booking->status === 'completed')
                                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                                        <form method="POST" action="{{ route('customer.reviews.store', $booking) }}" class="space-y-3">
                                            @csrf
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                                <div class="flex items-center">
                                                    <span class="text-sm font-medium mr-2">Rating:</span>
                                                    <div class="flex items-center">
                                                        <select name="rating" class="rounded-lg border-gray-200 text-sm py-1 px-2 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500" required>
                                                            <option value="">Pilih rating</option>
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <option value="{{ $i }}">{{ $i }} Bintang</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class="text-sm bg-purple-600 text-white px-3 py-1.5 rounded-lg hover:bg-purple-700 transition-colors duration-200 font-medium">
                                                    Kirim Review
                                                </button>
                                            </div>
                                            <textarea name="comment" rows="2" class="w-full rounded-lg border-gray-200 text-sm text-gray-700 p-2 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" placeholder="Bagikan pengalaman kamu dengan mitra ini..."></textarea>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">Belum ada riwayat booking.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
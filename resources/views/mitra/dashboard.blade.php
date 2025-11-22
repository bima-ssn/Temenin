<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Mitra</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Ringkasan aktivitas Anda</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ now()->format('d M Y, H:i') }}</span>
                </div>
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Quick Stats & Actions -->
            <div class="grid gap-6 lg:grid-cols-4">
                <!-- Stats Cards -->
                <div class="lg:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pending</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['pending'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">Menunggu konfirmasi</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center dark:bg-blue-900/20">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Disetujui</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['approved'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">Booking aktif</p>
                            </div>
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center dark:bg-green-900/20">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Selesai</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['completed'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">Total selesai</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center dark:bg-purple-900/20">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Rating</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($stats['rating'], 1) }}</p>
                                <p class="text-xs text-gray-500 mt-1">Dari {{ $stats['reviews'] ?? 0 }} ulasan</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center dark:bg-yellow-900/20">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions - PERBAIKAN: Gunakan route yang sudah ada -->
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-5 text-white">
                    <h3 class="font-semibold text-white mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <!-- Route mitra.profile SUDAH ADA -->
                        <a href="{{ route('mitra.profile') }}" class="flex items-center space-x-3 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Profil Saya</span>
                        </a>

                        <!-- Route mitra.bookings SUDAH ADA -->
                        <a href="{{ route('mitra.bookings') }}" class="flex items-center space-x-3 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Semua Booking</span>
                        </a>

                        <!-- Route mitra.approval SUDAH ADA -->
                        <a href="{{ route('mitra.approval') }}" class="flex items-center space-x-3 p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Status Approval</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Status Alert & Performance -->
            <div class="grid gap-6 lg:grid-cols-3">
                @if ($profile?->status !== 'approved')
                <div class="lg:col-span-2 bg-yellow-50 rounded-2xl p-5 border border-yellow-200 dark:bg-yellow-900/20 dark:border-yellow-800">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center dark:bg-yellow-800">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-200">Perhatian: Profil Belum Disetujui</h4>
                            <p class="text-yellow-700 dark:text-yellow-300 text-sm mt-1">
                                Profil Anda masih <span class="font-semibold">{{ $profile?->status ?? 'belum lengkap' }}</span>. 
                                Lengkapi profil dan tunggu persetujuan Admin untuk mulai menerima booking.
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="lg:col-span-2 bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Performance Bulan Ini</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['monthly_completed'] ?? 0 }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Booking selesai</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp{{ number_format($stats['monthly_income'] ?? 0, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Pendapatan</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Availability Status -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Status Ketersediaan</h4>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Siap Menerima Booking</span>
                        <div class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-not-allowed rounded-full border-2 border-transparent bg-gray-200 opacity-50">
                            <span class="sr-only">Toggle availability</span>
                            <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Fitur akan tersedia segera</p>
                </div>
            </div>

            <!-- Recent Bookings - PERBAIKAN: Tambahkan link "Lihat Semua" -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center dark:bg-indigo-900/20">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Booking Terbaru</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Booking yang membutuhkan perhatian Anda</p>
                        </div>
                    </div>
                    <!-- Route mitra.bookings SUDAH ADA -->
                    <a href="{{ route('mitra.bookings') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium dark:text-blue-400">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($recentBookings as $booking)
                        <div class="border border-gray-200 rounded-xl p-4 dark:border-gray-700 hover:border-blue-300 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center dark:bg-gray-700">
                                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $booking->customer?->name }}</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $booking->scheduled_date->format('d M Y') }} • {{ $booking->start_time }}
                                            @if($booking->duration)
                                                • {{ $booking->duration }} jam
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full dark:bg-gray-700 dark:text-gray-200">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="mt-3 flex gap-2">
                                @if ($booking->status === 'pending')
                                    <form method="POST" action="{{ route('mitra.bookings.approve', $booking) }}">
                                        @csrf
                                        <x-primary-button class="text-sm px-4 py-2">Terima</x-primary-button>
                                    </form>
                                    <form method="POST" action="{{ route('mitra.bookings.reject', $booking) }}">
                                        @csrf
                                        <input type="hidden" name="reason" value="Tidak tersedia">
                                        <x-secondary-button class="text-sm px-4 py-2">Tolak</x-secondary-button>
                                    </form>
                                @endif
                                @if ($booking->status === 'paid')
                                    <form method="POST" action="{{ route('mitra.bookings.complete', $booking) }}">
                                        @csrf
                                        <x-secondary-button class="text-sm px-4 py-2">Selesaikan</x-secondary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">Belum ada booking</p>
                            <p class="text-sm text-gray-400">Booking dari customer akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
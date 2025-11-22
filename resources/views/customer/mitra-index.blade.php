<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Pilih Mitra TemanNgobrol
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Temukan mitra ngobrol yang tepat sesuai minat dan kebutuhan Anda</p>
            </div>

            <form class="flex items-center gap-3" method="GET">
                <div class="relative flex-1 min-w-[280px]">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari berdasarkan minat, kota, atau nama..." 
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-600 transition-all duration-200"
                    />
                </div>
                <x-primary-button class="px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    Cari
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-blue-100 dark:border-blue-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-600 dark:text-blue-400 text-sm font-semibold">Total Mitra</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $mitra->total() }}</p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-800 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 border border-green-100 dark:border-green-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-600 dark:text-green-400 text-sm font-semibold">Rating Tertinggi</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">5.0</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-800 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-2xl p-6 border border-purple-100 dark:border-purple-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-600 dark:text-purple-400 text-sm font-semibold">Tarif Rata-rata</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp75k/jam</p>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-800 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($mitra as $profile)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Header dengan foto dan nama -->
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <img 
                                    src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://api.dicebear.com/9.x/initials/svg?seed='.$profile->user?->name }}" 
                                    alt="{{ $profile->user?->name }}" 
                                    class="h-16 w-16 rounded-2xl object-cover border-2 border-white dark:border-gray-700 shadow-md group-hover:border-indigo-200 transition-colors duration-300"
                                >
                                <div class="absolute -bottom-1 -right-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                    {{ number_format($profile->rating_average, 1) }}⭐
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-lg text-gray-900 dark:text-white truncate">{{ $profile->user?->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ $profile->tagline ?: 'Teman ngobrol yang asyik dan berpengalaman' }}</p>
                            </div>
                        </div>

                        <!-- Badge minat -->
                        @if(!empty($profile->interests))
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                @foreach(array_slice($profile->interests, 0, 3) as $interest)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                        {{ $interest }}
                                    </span>
                                @endforeach
                                @if(count($profile->interests) > 3)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                        +{{ count($profile->interests) - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Informasi detail -->
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">{{ $profile->city ?? 'Domisili belum diisi' }}</span>
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold text-green-600 dark:text-green-400">Rp{{ number_format($profile->rate_per_hour, 0, ',', '.') }}/jam</span>
                            </div>
                        </div>

                        <!-- Footer dengan rating dan tombol -->
                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ number_format($profile->rating_average, 1) }}</span>
                                </div>
                                <span>•</span>
                                <span>{{ $profile->reviews_count }} ulasan</span>
                            </div>
                            <a 
                                href="{{ route('customer.mitra.show', $profile) }}" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105"
                            >
                                Lihat Profil
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16">
                        <div class="w-24 h-24 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada mitra aktif</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                            Saat ini belum ada mitra yang tersedia. Silakan coba lagi nanti atau gunakan kata kunci pencarian yang berbeda.
                        </p>
                        <a 
                            href="{{ route('customer.mitra.index') }}" 
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Muat Ulang Halaman
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($mitra->hasPages())
                <div class="mt-12 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    {{ $mitra->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
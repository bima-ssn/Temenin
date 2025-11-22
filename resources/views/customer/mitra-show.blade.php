<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://api.dicebear.com/9.x/initials/svg?seed='.$profile->user?->name }}" alt="" class="h-16 w-16 rounded-full object-cover">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $profile->user?->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $profile->tagline }}</p>
                    <p class="text-xs text-gray-400">Domisili {{ $profile->city ?? 'N/A' }} • {{ $profile->experience_years }} th pengalaman</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Tarif mulai</p>
                <p class="text-3xl font-semibold text-indigo-600">Rp{{ number_format($profile->rate_per_hour, 0, ',', '.') }}/jam</p>
                <a href="{{ route('customer.booking.form', $profile) }}" class="mt-2 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 font-semibold text-white shadow hover:bg-indigo-700">Booking</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tentang Mitra</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $profile->description ?? 'Mitra ini belum menulis deskripsi.' }}</p>

                <div class="mt-6 grid gap-4 md:grid-cols-3 text-sm text-gray-500">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Minat</p>
                        <p>{{ implode(', ', $profile->interests ?? []) ?: '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Jadwal</p>
                        <p>{{ implode(', ', $profile->available_days ?? []) ?: '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Jam tersedia</p>
                        <p>{{ implode(', ', $profile->available_time_slots ?? []) ?: '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Review</h3>
                <div class="space-y-4">
                    @forelse ($reviews as $review)
                        <div class="rounded-2xl border border-gray-100 p-4 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $review->customer?->name }}</p>
                                <span class="rounded-full bg-indigo-100 px-2 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-200">
                                    {{ $review->rating }} / 5
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada review.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Mitra
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @foreach ($mitra as $user)
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->mitraProfile?->tagline }}</p>
                            <p class="mt-1 text-xs text-gray-400">Domisili: {{ $user->city ?? '-' }} • Status: {{ $user->mitraProfile?->status ?? 'Belum lengkap' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Tarif</p>
                            <p class="text-xl font-semibold text-indigo-600">Rp{{ number_format($user->mitraProfile?->rate_per_hour ?? 0, 0, ',', '.') }}/jam</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $mitra->links() }}
        </div>
    </div>
</x-app-layout>


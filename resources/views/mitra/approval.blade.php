<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Status Persetujuan Mitra
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-100 bg-white p-6 text-center shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm text-gray-500">Status anda saat ini</p>
                <p class="mt-2 text-3xl font-semibold @class([
                    'text-yellow-500' => $profile?->status === 'pending',
                    'text-green-600' => $profile?->status === 'approved',
                    'text-red-500' => $profile?->status === 'rejected',
                    'text-gray-500' => ! $profile?->status,
                ])">
                    {{ ucfirst($profile->status ?? 'Belum ada profil') }}
                </p>
                <p class="mt-3 text-sm text-gray-500">
                    @if ($profile?->status === 'pending')
                        Mohon tunggu Admin memverifikasi data Anda. Pastikan profil lengkap.
                    @elseif ($profile?->status === 'approved')
                        Selamat! Anda sudah bisa menerima booking.
                    @elseif ($profile?->status === 'rejected')
                        Profil ditolak. Perbarui profil untuk mengajukan lagi.
                    @else
                        Lengkapi profil terlebih dahulu.
                    @endif
                </p>
                <a href="{{ route('mitra.profile') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 font-semibold text-white">
                    Kelola Profil
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


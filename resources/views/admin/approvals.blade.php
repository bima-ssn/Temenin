<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Persetujuan Mitra
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500">Tinjau pengajuan mitra baru.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Nama</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Domisili</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Tarif</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Pengalaman</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($pendingMitra as $profile)
                                <tr>
                                    <td class="px-4 py-4">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $profile->user?->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $profile->tagline }}</p>
                                    </td>
                                    <td class="px-4 py-4">{{ $profile->city ?? '-' }}</td>
                                    <td class="px-4 py-4">Rp{{ number_format($profile->rate_per_hour, 0, ',', '.') }}/jam</td>
                                    <td class="px-4 py-4">{{ $profile->experience_years }} th</td>
                                    <td class="px-4 py-4 space-y-2">
                                        <form method="POST" action="{{ route('admin.approvals.approve', $profile) }}">
                                            @csrf
                                            <x-primary-button class="w-full justify-center">Setujui</x-primary-button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.approvals.reject', $profile) }}">
                                            @csrf
                                            <textarea name="reason" rows="2" class="w-full rounded border-gray-300 text-sm" placeholder="Catatan penolakan" required></textarea>
                                            <x-secondary-button class="mt-2 w-full justify-center bg-red-50 text-red-600 hover:bg-red-100">Tolak</x-secondary-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada pengajuan baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $pendingMitra->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


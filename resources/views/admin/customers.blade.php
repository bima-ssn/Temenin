<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Customer
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Nama</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Email</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Domisili</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Booking</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($customers as $customer)
                                <tr>
                                    <td class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-100">{{ $customer->name }}</td>
                                    <td class="px-4 py-3">{{ $customer->email }}</td>
                                    <td class="px-4 py-3">{{ $customer->city ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $customer->customer_bookings_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


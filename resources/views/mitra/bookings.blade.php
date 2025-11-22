<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Booking Masuk
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @foreach ($bookings as $booking)
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $booking->customer?->name }}</p>
                            <p class="text-sm text-gray-500">{{ $booking->scheduled_date->format('d M Y') }} • {{ $booking->start_time }} WIB</p>
                            <p class="text-xs text-gray-400">Durasi {{ $booking->duration_hours }} jam • Tarif Rp{{ number_format($booking->price, 0, ',', '.') }}</p>
                        </div>
                        <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-200">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-3">
                        @if ($booking->status === 'pending')
                            <form method="POST" action="{{ route('mitra.bookings.approve', $booking) }}">
                                @csrf
                                <x-primary-button>Terima</x-primary-button>
                            </form>
                            <form method="POST" action="{{ route('mitra.bookings.reject', $booking) }}" class="flex items-center gap-2">
                                @csrf
                                <input type="text" name="reason" class="rounded border-gray-200 text-sm" placeholder="Alasan" required>
                                <x-secondary-button class="bg-red-50 text-red-600 hover:bg-red-100">Tolak</x-secondary-button>
                            </form>
                        @endif
                        @if ($booking->chat_opened_at)
                            <a href="{{ route('mitra.chat.show', $booking) }}" class="rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700">Buka Chat</a>
                        @endif
                        @if ($booking->status === 'paid')
                            <form method="POST" action="{{ route('mitra.bookings.complete', $booking) }}">
                                @csrf
                                <x-secondary-button>Tandai Selesai</x-secondary-button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>


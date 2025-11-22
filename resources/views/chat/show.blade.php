<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Chat Booking {{ $booking->booking_code }}
            </h2>
            <p class="text-sm text-gray-500">Terhubung dengan {{ auth()->id() === $booking->customer_id ? $booking->mitra?->name : $booking->customer?->name }}</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 flex flex-col h-[600px]">
                <div class="flex-1 overflow-y-auto space-y-4 p-6">
                    @forelse ($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="rounded-2xl px-4 py-2 text-sm {{ $message->sender_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-900 dark:text-gray-100' }}">
                                <p class="font-semibold text-xs mb-1">{{ $message->sender->name }}</p>
                                <p>{{ $message->message }}</p>
                                <p class="mt-1 text-[10px] opacity-70">{{ $message->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-sm text-gray-500">Mulai percakapan pertama Anda!</p>
                    @endforelse
                </div>
                <form method="POST" action="{{ route(str_contains(request()->route()->getName(), 'mitra.') ? 'mitra.chat.store' : 'customer.chat.store', $booking) }}" class="border-t border-gray-100 dark:border-gray-700 p-4">
                    @csrf
                    <div class="flex gap-3">
                        <textarea name="message" rows="2" class="flex-1 rounded-2xl border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" placeholder="Tulis pesan..." required></textarea>
                        <x-primary-button class="h-12 self-end">Kirim</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


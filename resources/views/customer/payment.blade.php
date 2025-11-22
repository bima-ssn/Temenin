<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pembayaran Booking {{ $booking->booking_code }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 space-y-6">
                <div>
                    <p class="text-sm text-gray-500">Total Tagihan</p>
                    <p class="text-3xl font-semibold text-indigo-600">Rp{{ number_format($booking->price, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400">Bayar sebelum {{ optional($booking->payment_due_at)->format('d M Y H:i') }}</p>
                </div>

                <form method="POST" action="{{ route('customer.payments.store', $booking) }}" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label value="Metode Pembayaran" />
                        <div class="mt-3 grid gap-3 md:grid-cols-3">
                            @foreach (['bank_transfer' => 'Transfer Bank', 'ewallet' => 'E-Wallet', 'cash' => 'Bayar Tunai'] as $method => $label)
                                <label class="flex items-center gap-2 rounded-2xl border p-3 text-sm font-medium {{ old('method', 'bank_transfer') === $method ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30' : 'border-gray-200 dark:border-gray-700' }}">
                                    <input type="radio" name="method" value="{{ $method }}" {{ old('method', 'bank_transfer') === $method ? 'checked' : '' }}>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('method')" class="mt-2" />
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-4 text-sm text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                        Pembayaran ini bersifat dummy. Klik tombol bayar untuk menyelesaikan simulasi.
                    </div>

                    <x-primary-button class="w-full justify-center">Bayar Sekarang</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


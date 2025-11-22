<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Booking {{ $profile->user?->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('customer.booking.store', $profile) }}" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 space-y-6">
                @csrf
                <div>
                    <x-input-label for="scheduled_date" value="Tanggal" />
                    <x-text-input id="scheduled_date" name="scheduled_date" type="date" class="mt-1 block w-full" value="{{ old('scheduled_date') }}" required />
                    <x-input-error :messages="$errors->get('scheduled_date')" class="mt-2" />
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label for="start_time" value="Mulai" />
                        <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" value="{{ old('start_time') }}" required />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="duration_hours" value="Durasi (jam)" />
                        <x-text-input id="duration_hours" name="duration_hours" type="number" min="1" max="8" class="mt-1 block w-full" value="{{ old('duration_hours', 2) }}" required />
                        <x-input-error :messages="$errors->get('duration_hours')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label value="Tipe Pertemuan" />
                    <div class="mt-2 flex gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <input type="radio" name="meeting_type" value="online" {{ old('meeting_type', 'online') === 'online' ? 'checked' : '' }}>
                            Online
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <input type="radio" name="meeting_type" value="offline" {{ old('meeting_type') === 'offline' ? 'checked' : '' }}>
                            Offline
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('meeting_type')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="location" value="Lokasi (jika offline)" />
                    <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ old('location') }}" />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="notes" value="Catatan" />
                    <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">{{ old('notes') }}</textarea>
                </div>

                <x-primary-button class="w-full justify-center text-center">
                    Kirim Booking
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pengaturan Profil Mitra
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('mitra.profile.update') }}" class="space-y-6 rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                @csrf

                <div>
                    <x-input-label for="tagline" value="Tagline" />
                    <x-text-input id="tagline" name="tagline" class="mt-1 block w-full" value="{{ old('tagline', $profile?->tagline) }}" required />
                    <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" required>{{ old('description', $profile?->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label for="city" value="Domisili" />
                        <x-text-input id="city" name="city" class="mt-1 block w-full" value="{{ old('city', $profile?->city) }}" required />
                    </div>
                    <div>
                        <x-input-label for="rate_per_hour" value="Tarif / jam" />
                        <x-text-input id="rate_per_hour" name="rate_per_hour" type="number" min="50000" class="mt-1 block w-full" value="{{ old('rate_per_hour', $profile?->rate_per_hour) }}" required />
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label for="experience_years" value="Pengalaman (tahun)" />
                        <x-text-input id="experience_years" name="experience_years" type="number" min="0" class="mt-1 block w-full" value="{{ old('experience_years', $profile?->experience_years) }}" />
                    </div>
                    <div>
                        <x-input-label value="Hari tersedia" />
                        <div class="mt-2 grid grid-cols-3 gap-2 text-sm">
                            @php($days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'])
                            @foreach ($days as $day)
                                @php($normalizedDays = old('available_days', optional($profile)->available_days ?? []))
                                <label class="flex items-center gap-1">
                                    <input type="checkbox" name="available_days[]" value="{{ strtolower($day) }}" {{ in_array(strtolower($day), $normalizedDays, true) ? 'checked' : '' }}>
                                    {{ $day }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div>
                    <x-input-label for="available_time_slots" value="Jam tersedia (pisahkan dengan koma)" />
                    <x-text-input id="available_time_slots" name="available_time_slots" type="text" class="mt-1 block w-full" value="{{ old('available_time_slots', implode(', ', optional($profile)->available_time_slots ?? [])) }}" placeholder="Contoh: 09:00-12:00, 19:00-21:00" />
                    <x-input-error :messages="$errors->get('available_time_slots')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="interests" value="Minat (pisahkan dengan koma)" />
                    <x-text-input id="interests" name="interests" class="mt-1 block w-full" value="{{ old('interests', implode(', ', optional($profile)->interests ?? [])) }}" />
                    <x-input-error :messages="$errors->get('interests')" class="mt-2" />
                </div>

                <x-primary-button class="w-full justify-center">Simpan Profil</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>


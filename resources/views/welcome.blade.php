@php
    $topMitra = $topMitra ?? collect();
@endphp

<x-guest-layout>
    <div class="bg-gradient-to-b from-indigo-50 via-white to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-900">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <header class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <x-application-logo class="h-11 w-11 text-indigo-600" />
                    <div>
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">TemanIn</p>
                        <p class="text-xs text-gray-500">Teman ngobrol kapan pun kamu perlu</p>
                    </div>
                </div>
                <nav class="hidden md:flex items-center gap-5 text-sm text-gray-600 dark:text-gray-300">
                    <a href="#fitur" class="hover:text-indigo-600">Fitur</a>
                    <a href="#mitra" class="hover:text-indigo-600">Mitra</a>
                    <a href="#review" class="hover:text-indigo-600">Review</a>
                    <a href="#faq" class="hover:text-indigo-600">FAQ</a>
                </nav>
                <div class="flex items-center gap-3 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-xl border border-indigo-200/80 px-4 py-2 font-semibold text-indigo-600 hover:bg-indigo-50">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600">Masuk</a>
                        <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-4 py-2 font-semibold text-white shadow hover:bg-indigo-700">Daftar</a>
                    @endauth
                </div>
            </header>
        </div>

        <main class="max-w-6xl mx-auto px-6 space-y-16 pb-20">
            <section class="grid gap-12 lg:grid-cols-2">
                <div class="space-y-6">
                    <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">Teman ngobrol profesional</span>
                    <h1 class="text-4xl font-bold text-gray-900 leading-snug dark:text-white">
                        Curhat, diskusi, atau butuh pendamping? TemanIn siap 24/7.
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        Pilih mitra sesuai minat, atur jadwal, bayar aman, dan chat langsung setelah booking disetujui. Semua dalam satu platform.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="rounded-2xl bg-indigo-600 px-6 py-3 font-semibold text-white shadow hover:bg-indigo-700">Mulai Sekarang</a>
                        <a href="#mitra" class="rounded-2xl border border-indigo-200 px-6 py-3 font-semibold text-indigo-600 hover:bg-indigo-50">Lihat Mitra</a>
                    </div>
                    <dl class="grid grid-cols-3 gap-6 text-sm text-gray-500">
                        <div>
                            <dt class="text-2xl font-semibold text-gray-900 dark:text-white">150+</dt>
                            <dd>Mitra aktif</dd>
                        </div>
                        <div>
                            <dt class="text-2xl font-semibold text-gray-900 dark:text-white">4.9/5</dt>
                            <dd>Rating rata-rata</dd>
                        </div>
                        <div>
                            <dt class="text-2xl font-semibold text-gray-900 dark:text-white">98%</dt>
                            <dd>Klien puas</dd>
                        </div>
                    </dl>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80" alt="TemanIn hero" class="rounded-[32px] shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-800">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Mitra Favorit Minggu Ini</p>
                        <p class="text-xs text-gray-500 dark:text-gray-300">Rani • Expert Healing Session</p>
                        <div class="mt-3 flex items-center gap-2 text-xs text-amber-500">
                            ★★★★★
                            <span class="text-gray-500 dark:text-gray-300">4.95 (320 ulasan)</span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fitur" class="space-y-10">
                <div class="text-center space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-indigo-500">Fitur TemanIn</span>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Semua kebutuhanmu ada di sini</h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">TemanIn memastikan sesi obrolanmu selalu aman, nyaman, dan bermanfaat.</p>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ([
                        ['Mitra terverifikasi','Semua mitra melewati proses kurasi admin dan monitoring rating.'],
                        ['Booking & pembayaran aman','Pilih jadwal, tunggu approve, bayar aman, dan pantau status.'],
                        ['Chat & review','Chat aktif otomatis setelah bayar, review bisa diberikan setelah sesi selesai.'],
                    ] as $index => $fitur)
                        <article class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 text-xl font-bold">{{ $index + 1 }}</div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">{{ $fitur[0] }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $fitur[1] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="mitra" class="space-y-8">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-indigo-500">Top Mitra</p>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Teman terbaikmu siap menemani</h2>
                        <p class="text-gray-600 dark:text-gray-300 max-w-2xl">Profil menampilkan tarif, minat, pengalaman, dan jadwal agar kamu bisa memilih yang paling cocok.</p>
                    </div>
                    <a href="{{ route('customer.mitra.index') }}" class="rounded-2xl border border-indigo-200 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50">Lihat semua</a>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @forelse ($topMitra as $profile)
                        <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <div class="flex items-center gap-4">
                                <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://api.dicebear.com/9.x/initials/svg?seed='.($profile->user?->name ?? 'TemanIn') }}" class="h-14 w-14 rounded-full object-cover" alt="Mitra {{ $profile->user?->name }}">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $profile->user?->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $profile->tagline ?? 'Mitra TemanIn' }}</p>
                                </div>
                            </div>
                            <div class="mt-4 text-sm text-gray-500 dark:text-gray-300 space-y-1">
                                <p>Domisili: <strong class="text-gray-900 dark:text-white">{{ $profile->city ?? '-' }}</strong></p>
                                <p>Tarif: <strong class="text-indigo-600">Rp{{ number_format($profile->rate_per_hour ?? 0, 0, ',', '.') }}/jam</strong></p>
                                <p>Minat: {{ implode(', ', $profile->interests ?? []) ?: '-' }}</p>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-xs text-amber-500">
                                ★ {{ number_format($profile->rating_average, 1) }} ({{ $profile->reviews_count }} review)
                                <a href="{{ route('customer.mitra.show', $profile) }}" class="text-indigo-600 font-semibold hover:underline">Detail</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada mitra yang ditampilkan. Silakan login untuk mulai menggunakan TemanIn.</p>
                    @endforelse
                </div>
            </section>

            <section id="review" class="grid gap-10 lg:grid-cols-2">
                <div class="space-y-4">
                    <span class="text-xs uppercase tracking-wider text-indigo-500">Cerita nyata</span>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Ratusan sesi curhat dan diskusi produktif tiap hari</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        TemanIn membantu pelanggan merasa didengar, mendapatkan insight baru, hingga membangun circle yang sehat. Semua dengan mitra profesional.
                    </p>
                    <div class="rounded-3xl bg-indigo-600/10 p-6 text-sm text-gray-700 dark:text-gray-200">
                        “Dengan TemanIn aku bisa menemukan mitra yang suka buku. Setiap sesi meaningful dan bikin semangat lagi.”
                        <p class="mt-2 font-semibold text-gray-900 dark:text-white">- Laila • Customer</p>
                    </div>
                </div>
                <div class="space-y-4">
                    @foreach ([
                        ['“Dashboard TemanIn memudahkan saya mengatur jadwal dan komunikasi dengan pelanggan.”','Fajar • Mitra sejak 2024'],
                        ['“Pembayarannya aman dan transparan. Saya merasa dihargai sebagai profesional pendamping.”','Irene • Mitra'],
                        ['“Histori booking dan review rapi. Membantu memilih mitra sesuai kebutuhan.”','Ananda • Customer'],
                    ] as $review)
                        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $review[0] }}</p>
                            <p class="mt-3 font-semibold text-gray-900 dark:text-white">{{ $review[1] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="faq" class="bg-gray-50 dark:bg-gray-900/40 rounded-[32px] p-8 space-y-8">
                <div class="text-center space-y-2">
                    <span class="text-xs uppercase tracking-wider text-indigo-500">FAQ</span>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Pertanyaan umum</h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Masih ragu? Berikut jawaban dari pertanyaan yang sering kami terima.</p>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ([
                        ['Apakah mitra TemanIn profesional?','Ya. Mitra wajib melengkapi profil, melewati kurasi admin, dan menjaga rating agar tetap aktif.'],
                        ['Bagaimana alur booking?','Customer pilih mitra & jadwal, mitra approve, pembayaran dibuka otomatis.'],
                        ['Apakah bisa refund?','Jika mitra batal atau sesi tidak berjalan, admin dapat memproses refund sesuai kebijakan.'],
                        ['Bisakah saya jadi mitra?','Tentu. Daftar sebagai mitra, lengkapi profil, dan tunggu persetujuan admin.'],
                    ] as $faq)
                        <article class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $faq[0] }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $faq[1] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>
    </div>

    <footer class="border-t border-gray-200/60 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between text-sm text-gray-500 dark:text-gray-400">
            <p>© {{ date('Y') }} TemanIn. Seluruh hak cipta.</p>
            <div class="flex items-center gap-4">
                <a href="#fitur" class="hover:text-indigo-600">Fitur</a>
                <a href="#mitra" class="hover:text-indigo-600">Mitra</a>
                <a href="#faq" class="hover:text-indigo-600">FAQ</a>
                @guest
                    <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-4 py-1.5 font-semibold text-white hover:bg-indigo-700">Gabung sekarang</a>
                @endguest
            </div>
        </div>
    </footer>
</x-guest-layout>

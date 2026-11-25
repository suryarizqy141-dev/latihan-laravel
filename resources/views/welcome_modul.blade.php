@php
    $user = auth()->user();
    $initial = $user ? mb_strtoupper(mb_substr($user->name, 0, 1)) : '';

    $modules = [
        [
            'part' => 1,
            'title' => 'Route & View',
            'description' => 'Membuat route sederhana dan menampilkan halaman Blade pertama.',
            'tag' => 'Dasar',
            'links' => [
                ['label' => 'Halaman /hello', 'url' => url('/hello')],
            ],
        ],
        [
            'part' => 2,
            'title' => 'Controller',
            'description' => 'Memisahkan logika aplikasi dari route ke dalam controller.',
            'tag' => 'Struktur',
            'links' => [
                ['label' => 'Halaman /home', 'url' => url('/home')],
            ],
        ],
        [
            'part' => 3,
            'title' => 'Database & Eloquent',
            'description' => 'Model, migration, dan pengelolaan data kategori dengan Eloquent.',
            'tag' => 'Eloquent',
            'links' => [
                ['label' => 'Kelola kategori', 'url' => url('/categories')],
            ],
        ],
        [
            'part' => 4,
            'title' => 'Form & Validasi',
            'description' => 'Validasi input user dan menampilkan pesan kesalahan yang jelas.',
            'tag' => 'Validasi',
            'links' => [
                ['label' => 'Form input user', 'url' => url('/user')],
            ],
        ],
        [
            'part' => 5,
            'title' => 'CRUD Dasar',
            'description' => 'Create, Read, Update, dan Delete data user lengkap dengan pencarian.',
            'tag' => 'CRUD',
            'links' => [
                ['label' => 'Manajemen user', 'url' => url('/users')],
            ],
        ],
        [
            'part' => 6,
            'title' => 'Auth & Otorisasi',
            'description' => 'Login, registrasi, serta pembatasan halaman khusus role admin.',
            'tag' => 'Auth',
            'links' => $user
                ? [
                    ['label' => 'Dashboard pengguna', 'url' => url('/dashboard')],
                    ['label' => 'Halaman admin', 'url' => url('/admin')],
                ]
                : [
                    ['label' => 'Masuk', 'url' => url('/login')],
                    ['label' => 'Registrasi', 'url' => url('/register')],
                ],
        ],
        [
            'part' => 7,
            'title' => 'API Laravel',
            'description' => 'Autentikasi token Sanctum dan pengujian endpoint JSON dari browser.',
            'tag' => 'API',
            'links' => [
                ['label' => 'Uji coba API', 'url' => url('/api-test')],
            ],
        ],
    ];
@endphp

<x-app-layout title="Beranda" subtitle="Ringkasan seluruh latihan Bagian 1 sampai 7">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-6 sm:p-10">
        <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-rose-500/25 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-indigo-400/20 blur-3xl"></div>

        <div class="relative grid gap-8 lg:grid-cols-[1.4fr_1fr] lg:items-center">
            <div>
                <span class="badge bg-white/10 text-indigo-100">Laravel 12 &middot; PHP 8.3</span>
                <h2 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-white sm:text-4xl">
                    Modul Praktikum Web PHP
                </h2>
                <p class="mt-3 max-w-xl text-sm leading-relaxed text-indigo-100 sm:text-base">
                    Semua latihan dari route dan view sampai autentikasi API sudah disusun rapi dan siap dijalankan.
                    Pilih bagian yang ingin kamu pelajari di bawah.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn bg-white text-indigo-700 shadow-lg hover:bg-indigo-50">
                            Buka dashboard
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        @if ($user->role === 'admin')
                            <a href="{{ url('/admin') }}"
                                class="btn border border-white/20 bg-white/10 text-white hover:bg-white/20">
                                Admin area
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/login') }}" class="btn bg-white text-indigo-700 shadow-lg hover:bg-indigo-50">
                            Masuk sekarang
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ url('/register') }}"
                            class="btn border border-white/20 bg-white/10 text-white hover:bg-white/20">
                            Buat akun
                        </a>
                    @endauth
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-2 text-xs text-indigo-200">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        7 bagian materi
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        Role user &amp; admin
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        REST API
                    </span>
                </div>
            </div>

            <div class="rounded-3xl border border-white/15 bg-white/10 p-5 backdrop-blur">
                @auth
                    <div class="flex items-center gap-3">
                        <span
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-lg font-bold text-indigo-700">
                            {{ $initial }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-white">{{ $user->name }}</p>
                            <p class="truncate text-xs text-indigo-200">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between rounded-xl bg-white/10 px-3.5 py-2.5">
                        <span class="text-xs text-indigo-200">Status akun</span>
                        <span class="badge {{ $user->role === 'admin' ? 'bg-rose-500/20 text-rose-100' : 'bg-emerald-500/20 text-emerald-100' }}">
                            {{ $user->role === 'admin' ? 'Administrator' : 'User aktif' }}
                        </span>
                    </div>

                    <div class="mt-4 space-y-2">
                        <a href="{{ url('/dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-white/10 px-3.5 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                            Dashboard
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                        @if ($user->role === 'admin')
                            <a href="{{ url('/admin') }}"
                                class="flex items-center justify-between rounded-xl bg-white/10 px-3.5 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                                Admin area
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        @endif
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center justify-between rounded-xl bg-white/10 px-3.5 py-2.5 text-sm font-medium text-rose-100 transition hover:bg-rose-500/20">
                                Logout
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-sm font-semibold text-white">Belum masuk</p>
                    <p class="mt-1 text-xs leading-relaxed text-indigo-200">
                        Masuk untuk membuka dashboard, manajemen user, dan area khusus admin.
                    </p>
                    <div class="mt-4 space-y-2">
                        <a href="{{ url('/login') }}" class="btn w-full bg-white text-indigo-700 hover:bg-indigo-50">
                            Masuk
                        </a>
                        <a href="{{ url('/register') }}"
                            class="btn w-full border border-white/20 bg-white/10 text-white hover:bg-white/20">
                            Daftar akun
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Bagian materi', 'value' => '7', 'hint' => 'Route sampai API'],
            ['label' => 'Halaman CRUD', 'value' => '2', 'hint' => 'User & kategori'],
            ['label' => 'Role akses', 'value' => '2', 'hint' => 'User & admin'],
            ['label' => 'Token API', 'value' => 'Sanctum', 'hint' => 'Siap diuji'],
        ] as $stat)
            <div class="card p-5">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">{{ $stat['label'] }}</p>
                <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">{{ $stat['value'] }}</p>
                <p class="mt-1 text-xs text-slate-500">{{ $stat['hint'] }}</p>
            </div>
        @endforeach
    </section>

    <section class="mt-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold tracking-tight text-slate-900">Daftar bagian praktikum</h3>
                <p class="mt-1 text-sm text-slate-500">Klik salah satu tautan untuk langsung mencoba hasil latihannya.</p>
            </div>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($modules as $module)
                <article class="card group flex flex-col p-5 transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-rose-500 text-sm font-black text-white shadow-sm shadow-indigo-600/20">
                            {{ str_pad($module['part'], 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="badge badge-slate">{{ $module['tag'] }}</span>
                    </div>

                    <h4 class="mt-4 text-base font-semibold text-slate-900">
                        Bagian {{ $module['part'] }}: {{ $module['title'] }}
                    </h4>
                    <p class="mt-1.5 flex-1 text-sm leading-relaxed text-slate-500">{{ $module['description'] }}</p>

                    <div class="mt-4 flex flex-wrap gap-2 border-t border-slate-100 pt-4">
                        @foreach ($module['links'] as $link)
                            <a href="{{ $link['url'] }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700">
                                {{ $link['label'] }}
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-app-layout>

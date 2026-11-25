@props([
    'title' => 'Masuk',
    'subtitle' => null,
])

<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} &middot; Modul Praktikum Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-800 antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        <aside class="relative hidden overflow-hidden bg-slate-950 p-12 lg:flex lg:flex-col lg:justify-between">
            <div
                class="pointer-events-none absolute -left-24 top-1/4 h-96 w-96 rounded-full bg-indigo-600/30 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -right-24 bottom-0 h-80 w-80 rounded-full bg-rose-500/20 blur-3xl">
            </div>

            <a href="{{ url('/') }}" class="relative flex items-center gap-3">
                <span
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-rose-500 text-xl font-black text-white shadow-xl shadow-indigo-500/30">
                    L
                </span>
                <span>
                    <span class="block text-base font-bold tracking-tight text-white">Modul Laravel</span>
                    <span class="block text-sm text-slate-400">Praktikum Web PHP</span>
                </span>
            </a>

            <div class="relative max-w-md">
                <p class="badge bg-white/10 text-indigo-200">Laravel 12 &middot; PHP 8.3</p>
                <h2 class="mt-5 text-4xl font-bold leading-tight tracking-tight text-white">
                    Belajar Laravel dari dasar sampai API.
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-400">
                    Satu tempat untuk menjalankan seluruh latihan Bagian 1 sampai 7: route, controller, Eloquent,
                    validasi, CRUD, autentikasi, hingga API Sanctum.
                </p>

                <ul class="mt-8 space-y-4">
                    @foreach ([
                        'Praktikum terstruktur dari route sampai API',
                        'Manajemen user dan kategori yang siap pakai',
                        'Autentikasi dengan pembatasan role admin',
                        'Pengujian endpoint API langsung dari browser',
                    ] as $feature)
                        <li class="flex items-start gap-3 text-sm text-slate-300">
                            <span
                                class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-indigo-500/20 text-indigo-300">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="relative text-xs text-slate-500">
                Modul Praktikum Laravel &middot; Bagian 1&ndash;7
            </p>
        </aside>

        <div class="relative flex flex-col items-center justify-center px-4 py-10 sm:px-8">
            <a href="{{ url('/') }}"
                class="btn btn-ghost btn-sm absolute right-4 top-4 text-slate-500 sm:right-8 sm:top-8">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Beranda
            </a>

            <div class="w-full max-w-md">
                <a href="{{ url('/') }}" class="mb-8 flex items-center gap-3 lg:hidden">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-rose-500 text-lg font-black text-white shadow-lg shadow-indigo-600/25">
                        L
                    </span>
                    <span>
                        <span class="block text-sm font-bold tracking-tight text-slate-900">Modul Laravel</span>
                        <span class="block text-xs text-slate-500">Praktikum Web PHP</span>
                    </span>
                </a>

                <div class="card p-6 sm:p-8">
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="mt-1.5 text-sm text-slate-500">{{ $subtitle }}</p>
                    @endif

                    <div class="mt-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.flash')
</body>
</html>

@props([
    'title' => 'Beranda',
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
    @php
        $user = auth()->user();
        $initial = $user ? mb_strtoupper(mb_substr($user->name, 0, 1)) : '';
        $navClass = fn (bool $active) => $active ? 'nav-link nav-link-active' : 'nav-link';
    @endphp

    <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-slate-900/50 backdrop-blur-sm lg:hidden"></div>

    <aside id="app-sidebar"
        class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col border-r border-slate-200 bg-white transition-transform duration-200 ease-in-out lg:translate-x-0">
        <div class="flex h-20 items-center justify-between px-5">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-rose-500 text-lg font-black text-white shadow-lg shadow-indigo-600/25">
                    L
                </span>
                <span>
                    <span class="block text-sm font-bold tracking-tight text-slate-900">Modul Laravel</span>
                    <span class="block text-xs text-slate-500">Praktikum Web PHP</span>
                </span>
            </a>

            <button type="button" data-sidebar-close
                class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 lg:hidden">
                <span class="sr-only">Tutup menu</span>
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto px-4 pb-6">
            <p class="px-3 pb-2 pt-3 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Menu Utama</p>

            <a href="{{ url('/') }}" class="{{ $navClass(request()->is('/')) }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Beranda
            </a>

            <a href="{{ url('/dashboard') }}" class="{{ $navClass(request()->is('dashboard')) }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Belajar CRUD
            </a>

            <p class="px-3 pb-2 pt-6 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Lainnya</p>


            <a href="{{ url('/api-test') }}" class="{{ $navClass(request()->is('api-test')) }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                Uji API
            </a>

            @if ($user && $user->role === 'admin')
                <p class="px-3 pb-2 pt-6 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Administrator</p>

                <a href="{{ url('/admin') }}" class="{{ $navClass(request()->is('admin')) }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                    Admin Area
                </a>
            @endif
        </nav>

        <div class="border-t border-slate-200 p-4">
            @auth
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
                    <div class="flex items-center gap-3">
                        <span
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-sm font-bold text-white">
                            {{ $initial }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-slate-800">{{ $user->name }}</p>
                            <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                        </div>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
                            {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                        </span>
                    </div>

                    <div class="mt-3 flex items-center gap-2">
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm flex-1">Belajar CRUD</a>
                        <form method="POST" action="{{ url('/logout') }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="btn btn-ghost btn-sm w-full text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
                    <p class="text-sm font-semibold text-slate-800">Belum masuk?</p>
                    <p class="mt-1 text-xs text-slate-500">Masuk untuk membuka dashboard dan area admin.</p>
                    <div class="mt-3 flex items-center gap-2">
                        <a href="{{ url('/login') }}" class="btn btn-primary btn-sm flex-1">Masuk</a>
                        <a href="{{ url('/register') }}" class="btn btn-secondary btn-sm flex-1">Daftar</a>
                    </div>
                </div>
            @endauth
        </div>
    </aside>

    <div class="flex min-h-screen flex-col lg:pl-72">
        <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/80 backdrop-blur">
            <div class="mx-auto flex h-20 w-full max-w-7xl items-center gap-4 px-4 sm:px-6 lg:px-8">
                <button type="button" id="sidebar-open"
                    class="-ml-2 rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 lg:hidden">
                    <span class="sr-only">Buka menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="min-w-0 flex-1">
                    <h1 class="truncate text-lg font-semibold tracking-tight text-slate-900 sm:text-xl">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="truncate text-sm text-slate-500">{{ $subtitle }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ url('/') }}"
                        class="btn btn-secondary btn-sm hidden sm:inline-flex">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        Modul
                    </a>

                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white py-1.5 pl-1.5 pr-3 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50">
                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                {{ $initial }}
                            </span>
                            <span class="hidden text-sm font-medium text-slate-700 sm:block">{{ $user->name }}</span>
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="btn btn-primary btn-sm">Masuk</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-8 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div
                class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:px-6 lg:px-8">
                <p>&copy; {{ date('Y') }} Modul Praktikum Laravel &middot; Bagian 1&ndash;7</p>
                <p>Laravel 12 &middot; PHP 8.3 &middot; Tailwind CSS</p>
            </div>
        </footer>
    </div>

    @include('partials.flash')

    <script>
        (function () {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const openButton = document.getElementById('sidebar-open');
            const closeButtons = document.querySelectorAll('[data-sidebar-close]');

            if (!sidebar || !overlay) return;

            const open = () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const close = () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            openButton?.addEventListener('click', open);
            overlay.addEventListener('click', close);
            closeButtons.forEach((button) => button.addEventListener('click', close));
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') close();
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>

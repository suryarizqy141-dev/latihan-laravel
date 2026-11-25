@php
    $user = auth()->user();
    $initial = mb_strtoupper(mb_substr($user->name, 0, 1));
@endphp

<x-app-layout title="Admin Area" subtitle="Halaman khusus role administrator">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-rose-950 p-6 sm:p-8">
        <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-rose-500/25 blur-3xl"></div>
        <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <span
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-rose-500/20 text-rose-200 ring-1 ring-rose-400/30">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                </span>
                <div>
                    <span class="badge bg-rose-500/20 text-rose-100">Administrator</span>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-white">Halo, {{ $user->name }}</h2>
                    <p class="mt-1 text-sm text-slate-400">
                        Halaman ini dilindungi middleware <code class="rounded bg-white/10 px-1.5 py-0.5 text-rose-200">auth</code>
                        dan <code class="rounded bg-white/10 px-1.5 py-0.5 text-rose-200">role:admin</code>.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ url('/dashboard') }}" class="btn border border-white/15 bg-white/10 text-white hover:bg-white/20">
                    Dashboard
                </a>
                <a href="{{ url('/users') }}" class="btn bg-white text-slate-900 hover:bg-slate-100">
                    Kelola user
                </a>
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Total user', 'value' => $stats['users'], 'tone' => 'bg-indigo-50 text-indigo-600'],
            ['label' => 'Administrator', 'value' => $stats['admins'], 'tone' => 'bg-rose-50 text-rose-600'],
            ['label' => 'User biasa', 'value' => $stats['regular_users'], 'tone' => 'bg-emerald-50 text-emerald-600'],
            ['label' => 'Kategori', 'value' => $stats['categories'], 'tone' => 'bg-amber-50 text-amber-600'],
        ] as $card)
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">{{ $card['label'] }}</p>
                    <span class="h-2 w-2 rounded-full {{ $card['tone'] }}"></span>
                </div>
                <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </section>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.1fr_1fr]">
        <section>
            <h3 class="text-base font-semibold text-slate-900">Menu pengelolaan</h3>
            <p class="mt-1 text-sm text-slate-500">Semua fitur administrasi dalam satu tempat.</p>

            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                @foreach ([
                    [
                        'title' => 'Manajemen user',
                        'text' => 'CRUD user, filter role, dan pencarian.',
                        'url' => url('/users'),
                        'tone' => 'bg-indigo-50 text-indigo-600',
                        'icon' => 'users',
                    ],
                    [
                        'title' => 'Kategori',
                        'text' => 'Tambah, edit, dan hapus kategori.',
                        'url' => url('/categories'),
                        'tone' => 'bg-amber-50 text-amber-600',
                        'icon' => 'tag',
                    ],
                    [
                        'title' => 'Pengujian API',
                        'text' => 'Uji login, profil, dan update user.',
                        'url' => url('/api-test'),
                        'tone' => 'bg-emerald-50 text-emerald-600',
                        'icon' => 'api',
                    ],
                    [
                        'title' => 'Form user',
                        'text' => 'Latihan form dan validasi input.',
                        'url' => url('/user'),
                        'tone' => 'bg-slate-100 text-slate-600',
                        'icon' => 'form',
                    ],
                ] as $menu)
                    <a href="{{ $menu['url'] }}"
                        class="card group p-5 transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $menu['tone'] }}">
                            @switch($menu['icon'])
                                @case('users')
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                @break

                                @case('tag')
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                    </svg>
                                @break

                                @case('api')
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                @break

                                @default
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                            @endswitch
                        </span>
                        <h4 class="mt-4 text-sm font-semibold text-slate-900">{{ $menu['title'] }}</h4>
                        <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ $menu['text'] }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-4 flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <p class="text-xs leading-relaxed text-amber-800">
                    Menu manajemen user terbuka untuk halaman latihan. Di aplikasi nyata, batasi operasi
                    tambah/edit/hapus hanya untuk administrator.
                </p>
            </div>
        </section>

        <section class="card overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 sm:px-6">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">User terbaru</h3>
                    <p class="mt-0.5 text-sm text-slate-500">Pantau akun yang baru bergabung.</p>
                </div>
                <a href="{{ url('/users') }}" class="btn btn-secondary btn-sm">Kelola</a>
            </div>

            @if ($recentUsers->isEmpty())
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-slate-500">Belum ada user.</p>
                    <a href="{{ url('/user') }}" class="btn btn-primary btn-sm mt-3">Tambah user</a>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach ($recentUsers as $recent)
                        <li class="flex items-center gap-3 px-5 py-3.5 sm:px-6">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-xs font-bold text-indigo-600">
                                {{ mb_strtoupper(mb_substr($recent->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-slate-800">{{ $recent->name }}</p>
                                <p class="truncate text-xs text-slate-500">{{ $recent->email }}</p>
                            </div>
                            <span class="badge {{ $recent->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
                                {{ $recent->role === 'admin' ? 'Admin' : 'User' }}
                            </span>
                            <a href="{{ url('/user/edit/' . $recent->id) }}"
                                class="text-xs font-semibold text-indigo-600 hover:text-indigo-500">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
</x-app-layout>

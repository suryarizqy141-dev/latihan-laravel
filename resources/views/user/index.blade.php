<x-app-layout title="Manajemen User" subtitle="Cari, tambah, edit, dan hapus data pengguna">
    <div class="grid gap-4 sm:grid-cols-3">
        @foreach ([
            ['label' => 'Total user', 'value' => $summary['total'], 'tone' => 'bg-indigo-50 text-indigo-600'],
            ['label' => 'Administrator', 'value' => $summary['admins'], 'tone' => 'bg-rose-50 text-rose-600'],
            ['label' => 'User biasa', 'value' => $summary['regular_users'], 'tone' => 'bg-emerald-50 text-emerald-600'],
        ] as $card)
            <div class="card flex items-center justify-between p-5">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">{{ $card['label'] }}</p>
                    <p class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ $card['value'] }}</p>
                </div>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $card['tone'] }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
            </div>
        @endforeach
    </div>

    <section class="card mt-6 overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h2 class="text-base font-semibold text-slate-900">Daftar user</h2>
                <p class="mt-0.5 text-sm text-slate-500">
                    @if ($users->total())
                        Menampilkan {{ $users->firstItem() }}&ndash;{{ $users->lastItem() }} dari
                        {{ $users->total() }} user.
                    @else
                        Belum ada data yang cocok.
                    @endif
                </p>
            </div>

            <a href="{{ url('/user') }}" class="btn btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah user
            </a>
        </div>

        <div class="border-b border-slate-200 bg-slate-50/70 p-5 sm:p-6">
            <form method="GET" action="{{ url('/users') }}" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex w-11 items-center justify-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </span>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, atau alamat..."
                        class="input pl-11">
                </div>

                <select name="role" class="input sm:w-44">
                    <option value="">Semua role</option>
                    <option value="user" @selected(request('role') === 'user')>User</option>
                    <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary flex-1 sm:flex-none">Terapkan</button>
                    @if (request()->filled('q') || request()->filled('role'))
                        <a href="{{ url('/users') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        @if ($users->isEmpty())
            <div class="px-6 py-14 text-center">
                <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
                <h3 class="mt-4 text-sm font-semibold text-slate-800">Tidak ada user ditemukan</h3>
                <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">
                    Coba ubah kata kunci pencarian atau filter role, atau tambahkan user baru.
                </p>
                <div class="mt-5 flex justify-center gap-2">
                    <a href="{{ url('/users') }}" class="btn btn-secondary btn-sm">Hapus filter</a>
                    <a href="{{ url('/user') }}" class="btn btn-primary btn-sm">Tambah user</a>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="table-th">User</th>
                            <th class="table-th hidden md:table-cell">Alamat</th>
                            <th class="table-th hidden xl:table-cell">Tanggal lahir</th>
                            <th class="table-th">Role</th>
                            <th class="table-th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($users as $user)
                            <tr class="transition hover:bg-slate-50/70">
                                <td class="table-td">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold text-indigo-600">
                                            {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate font-semibold text-slate-800">{{ $user->name }}</p>
                                            <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-td hidden md:table-cell">
                                    <span class="line-clamp-2 max-w-56 text-slate-600">{{ $user->alamat ?: '-' }}</span>
                                </td>
                                <td class="table-td hidden whitespace-nowrap xl:table-cell">
                                    {{ $user->tanggal_lahir?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="table-td">
                                    <span class="badge {{ $user->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
                                        {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td class="table-td">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ url('/user/edit/' . $user->id) }}"
                                            class="btn btn-ghost btn-sm text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ url('/user/' . $user->id) }}"
                                            onsubmit="return confirm('Hapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-ghost btn-sm text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </section>
</x-app-layout>

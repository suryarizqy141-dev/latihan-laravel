<x-app-layout title="Edit User" subtitle="Perbarui data pengguna tanpa harus menghapus akun">
    <div class="mb-5 flex items-center justify-between">
        <a href="{{ url('/users') }}" class="btn btn-secondary btn-sm">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke daftar user
        </a>
        <span class="badge {{ $user->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
            {{ $user->role === 'admin' ? 'Admin' : 'User' }}
        </span>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">
            <p class="text-sm font-semibold text-rose-700">
                Ada {{ $errors->count() }} data yang perlu diperbaiki.
            </p>
            <ul class="mt-2 space-y-1 pl-5 text-sm text-rose-600">
                @foreach ($errors->all() as $error)
                    <li class="list-disc">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <form action="{{ url('/user/update/' . $user->id) }}" method="POST" class="card p-5 sm:p-6">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="name" class="label">Nama lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus
                        class="input">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="input">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label for="alamat" class="label">Alamat <span class="font-normal text-slate-400">(opsional)</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="input resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="tanggal_lahir" class="label">Tanggal lahir
                        <span class="font-normal text-slate-400">(opsional)</span></label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}" class="input">
                    @error('tanggal_lahir')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="label">Role</label>
                    <select id="role" name="role" class="input">
                        <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    </select>
                    @error('role')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label for="password" class="label">Password baru
                    <span class="font-normal text-slate-400">(opsional)</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Biarkan kosong jika tidak diubah"
                        class="input pr-11">
                    <button type="button" data-toggle-password="password"
                        class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-slate-400 transition hover:text-slate-600"
                        aria-label="Tampilkan password" aria-pressed="false">
                        <svg data-eye class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg data-eye-off class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <p class="help">Password hanya berubah jika kolom ini diisi (minimal 6 karakter).</p>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-200 pt-5">
                <button type="submit" class="btn btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Simpan perubahan
                </button>
                <a href="{{ url('/users') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

        <aside class="space-y-4">
            <div class="card p-5">
                <h3 class="text-sm font-semibold text-slate-900">Informasi akun</h3>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">ID</dt>
                        <dd class="font-medium text-slate-800">#{{ $user->id }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">Dibuat</dt>
                        <dd class="font-medium text-slate-800">{{ $user->created_at?->format('d M Y') }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">Terakhir diubah</dt>
                        <dd class="font-medium text-slate-800">{{ $user->updated_at?->format('d M Y') }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">Role</dt>
                        <dd>
                            <span class="badge {{ $user->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
                                {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                <p class="text-sm font-semibold text-amber-800">Perhatian</p>
                <p class="mt-1.5 text-xs leading-relaxed text-amber-700">
                    Mengubah role menjadi admin memberikan akses ke halaman administrator. Pastikan perubahan ini
                    memang diperlukan.
                </p>
            </div>
        </aside>
    </div>
</x-app-layout>

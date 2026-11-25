<x-guest-layout title="Buat akun baru" subtitle="Lengkapi data di bawah untuk mulai menggunakan modul.">
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <p class="text-sm font-semibold text-rose-700">Ada {{ $errors->count() }} data yang perlu diperbaiki</p>
            </div>
            <ul class="mt-2 space-y-1 pl-7 text-sm text-rose-600">
                @foreach ($errors->all() as $error)
                    <li class="list-disc">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="label">Nama lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                autocomplete="name" placeholder="Contoh: Budi Santoso" class="input">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                placeholder="nama@email.com" class="input">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="label">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required autocomplete="new-password"
                        placeholder="Minimal 6 karakter" class="input pr-11">
                    <button type="button" data-toggle-password="password"
                        class="absolute inset-y-0 right-0 flex w-11 items-center justify-center rounded-r-xl text-slate-400 transition hover:text-slate-600"
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
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="label">Konfirmasi password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Ulangi password" class="input">
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="alamat" class="label">Alamat <span class="font-normal text-slate-400">(opsional)</span></label>
                <textarea id="alamat" name="alamat" rows="2" placeholder="Alamat tempat tinggal"
                    class="input resize-none">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_lahir" class="label">Tanggal lahir
                    <span class="font-normal text-slate-400">(opsional)</span></label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                    class="input">
                @error('tanggal_lahir')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <span class="label">Daftar sebagai</span>
            <div class="grid grid-cols-2 gap-3">
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="user" class="peer sr-only"
                        @checked(old('role', 'user') === 'user')>
                    <span
                        class="flex flex-col gap-1 rounded-xl border border-slate-200 bg-white p-3.5 transition peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-2 peer-checked:ring-indigo-500/20 hover:border-slate-300">
                        <span class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                            <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            User
                        </span>
                        <span class="text-xs text-slate-500">Akses dashboard</span>
                    </span>
                </label>

                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="admin" class="peer sr-only"
                        @checked(old('role') === 'admin')>
                    <span
                        class="flex flex-col gap-1 rounded-xl border border-slate-200 bg-white p-3.5 transition peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:ring-2 peer-checked:ring-rose-500/20 hover:border-slate-300">
                        <span class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                            <svg class="h-4 w-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            Admin
                        </span>
                        <span class="text-xs text-slate-500">Akses penuh</span>
                    </span>
                </label>
            </div>
            @error('role')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Daftar akun
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ url('/login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
            Masuk di sini
        </a>
    </p>
</x-guest-layout>

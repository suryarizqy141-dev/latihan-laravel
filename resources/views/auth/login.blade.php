<x-guest-layout title="Masuk ke akun" subtitle="Gunakan email dan password yang sudah terdaftar.">
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <p class="text-sm font-semibold text-rose-700">Login belum berhasil</p>
            </div>
            <ul class="mt-2 space-y-1 pl-7 text-sm text-rose-600">
                @foreach ($errors->all() as $error)
                    <li class="list-disc">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="email" placeholder="nama@email.com" class="input">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="label mb-0">Password</label>
                <span class="text-xs text-slate-400">Minimal 6 karakter</span>
            </div>
            <div class="relative mt-1.5">
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password" class="input pr-11">
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

        <label for="remember" class="flex cursor-pointer items-center gap-2.5 text-sm text-slate-600">
            <input type="checkbox" id="remember" name="remember" value="1" @checked(old('remember'))
                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            Ingat saya di perangkat ini
        </label>

        <button type="submit" class="btn btn-primary w-full">
            Masuk
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ url('/register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
            Daftar sekarang
        </a>
    </p>
</x-guest-layout>

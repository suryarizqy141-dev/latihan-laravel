<x-app-layout title="Halo, Laravel!" subtitle="Bagian 1: Route dan View sederhana">
    <div class="grid gap-6 lg:grid-cols-[1.3fr_1fr]">
        <div class="card relative overflow-hidden p-6 sm:p-8">
            <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-indigo-100/70 blur-2xl">
            </div>
            <div class="relative">
                <span class="badge badge-indigo">Bagian 1</span>
                <h2 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Selamat datang di Laravel!
                </h2>
                <p class="mt-3 max-w-lg text-sm leading-relaxed text-slate-500">
                    Halaman ini tampil karena sebuah route mengembalikan view Blade. Ini adalah fondasi dari seluruh
                    aplikasi Laravel yang akan kamu bangun.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ url('/home') }}" class="btn btn-primary">
                        Lanjut ke Bagian 2
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke beranda</a>
                </div>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="flex items-center gap-2 border-b border-slate-200 bg-slate-50 px-4 py-3">
                <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
                <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                <span class="ml-2 text-xs font-medium text-slate-500">routes/web.php</span>
            </div>
            <pre class="overflow-x-auto bg-slate-950 p-5 text-xs leading-relaxed text-slate-300"><code>Route::get(<span class="text-emerald-300">'/hello'</span>, <span class="text-indigo-300">function</span> () {
    <span class="text-indigo-300">return</span> view(<span class="text-emerald-300">'hello'</span>);
});</code></pre>
        </div>
    </div>
</x-app-layout>

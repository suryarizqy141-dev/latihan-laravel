<x-app-layout title="Halaman Home" subtitle="Bagian 2: Controller dan Struktur Proyek">
    <div class="card overflow-hidden">
        <div class="bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 px-6 py-10 sm:px-10">
            <span class="badge bg-white/10 text-indigo-100">PageController@home</span>
            <h2 class="mt-4 max-w-2xl text-2xl font-bold leading-tight tracking-tight text-white sm:text-3xl">
                Selamat datang di halaman utama Laravel!
            </h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-indigo-100">
                Route ini tidak lagi berisi logika langsung. Semua dipindahkan ke controller agar kode lebih rapi dan
                mudah dikembangkan.
            </p>
        </div>

        <div class="grid gap-4 p-6 sm:grid-cols-3 sm:p-8">
            @foreach ([
                ['title' => 'Route', 'text' => 'Menerima permintaan dari browser.', 'color' => 'indigo'],
                ['title' => 'Controller', 'text' => 'Menjalankan logika dan memilih view.', 'color' => 'rose'],
                ['title' => 'View', 'text' => 'Menampilkan hasil ke pengguna.', 'color' => 'emerald'],
            ] as $item)
                <div class="rounded-xl border border-slate-200 p-4">
                    <span class="badge badge-{{ $item['color'] }}">{{ $item['title'] }}</span>
                    <p class="mt-3 text-sm text-slate-600">{{ $item['text'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="flex flex-wrap gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:px-8">
            <a href="{{ url('/hello') }}" class="btn btn-secondary btn-sm">&larr; Bagian 1</a>
            <a href="{{ url('/categories') }}" class="btn btn-primary btn-sm">Lanjut ke Bagian 3</a>
        </div>
    </div>
</x-app-layout>

<x-app-layout title="Kategori" subtitle="Bagian 3: Eloquent model dan pengelolaan data kategori">
    <div class="grid gap-6 xl:grid-cols-[1.45fr_1fr]">
        <section class="card overflow-hidden">
            <div class="border-b border-slate-200 p-5 sm:p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Daftar kategori</h2>
                        <p class="mt-0.5 text-sm text-slate-500">
                            {{ $total }} kategori terdaftar.
                            @if ($search !== '')
                                Hasil pencarian &ldquo;{{ $search }}&rdquo;.
                            @endif
                        </p>
                    </div>
                    <span class="badge badge-amber">{{ $categories->total() }} hasil</span>
                </div>

                <form method="GET" action="{{ url('/categories') }}" class="mt-4 flex gap-2">
                    <div class="relative flex-1">
                        <span
                            class="pointer-events-none absolute inset-y-0 left-0 flex w-11 items-center justify-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </span>
                        <input type="search" name="q" value="{{ $search }}" placeholder="Cari kategori..."
                            class="input pl-11">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if ($search !== '')
                        <a href="{{ url('/categories') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </form>
            </div>

            @if ($categories->isEmpty())
                <div class="px-6 py-14 text-center">
                    <span
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                    </span>
                    <h3 class="mt-4 text-sm font-semibold text-slate-800">
                        {{ $search !== '' ? 'Kategori tidak ditemukan' : 'Belum ada kategori' }}
                    </h3>
                    <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">
                        {{ $search !== ''
                            ? 'Coba kata kunci lain atau reset pencarian.'
                            : 'Tambahkan kategori pertama menggunakan form di samping.' }}
                    </p>
                    @if ($search !== '')
                        <a href="{{ url('/categories') }}" class="btn btn-secondary btn-sm mt-5">Hapus pencarian</a>
                    @endif
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="table-th">Kategori</th>
                                <th class="table-th hidden md:table-cell">Dibuat</th>
                                <th class="table-th text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($categories as $category)
                                <tr class="transition hover:bg-slate-50/70">
                                    <td class="table-td">
                                        <div class="flex items-start gap-3">
                                            <span
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                                </svg>
                                            </span>
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-800">{{ $category->name }}</p>
                                                <p class="mt-0.5 line-clamp-2 max-w-md text-xs leading-relaxed text-slate-500">
                                                    {{ $category->description ?: 'Tanpa deskripsi' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-td hidden whitespace-nowrap md:table-cell">
                                        {{ $category->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="table-td">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ url('/categories/' . $category->id . '/edit') }}"
                                                class="btn btn-ghost btn-sm text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ url('/categories/' . $category->id) }}"
                                                onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
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

                @if ($categories->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                        {{ $categories->links() }}
                    </div>
                @endif
            @endif
        </section>

        <aside>
            <form action="{{ url('/categories') }}" method="POST" class="card p-5 sm:p-6">
                @csrf
                <div class="flex items-center gap-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900">Tambah kategori</h2>
                        <p class="text-xs text-slate-500">Simpan langsung ke database.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="name" class="label">Nama kategori</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        placeholder="Contoh: Teknologi" class="input">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="description" class="label">Deskripsi
                        <span class="font-normal text-slate-400">(opsional)</span></label>
                    <textarea id="description" name="description" rows="3" placeholder="Penjelasan singkat kategori"
                        class="input resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-5 w-full">Tambah kategori</button>
            </form>

            <div class="mt-4 rounded-2xl border border-indigo-200 bg-indigo-50 p-5">
                <p class="text-sm font-semibold text-indigo-800">Tentang bagian ini</p>
                <p class="mt-1.5 text-xs leading-relaxed text-indigo-700">
                    Data kategori dikelola dengan model Eloquent. Setiap perubahan langsung tersimpan dan tampil pada
                    daftar di samping.
                </p>
            </div>
        </aside>
    </div>
</x-app-layout>

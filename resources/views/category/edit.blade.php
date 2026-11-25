<x-app-layout title="Edit Kategori" subtitle="Perbarui nama atau deskripsi kategori">
    <div class="mb-5 flex items-center justify-between">
        <a href="{{ url('/categories') }}" class="btn btn-secondary btn-sm">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke kategori
        </a>
        <span class="badge badge-slate">ID #{{ $category->id }}</span>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <form action="{{ url('/categories/' . $category->id) }}" method="POST" class="card p-5 sm:p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="label">Nama kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                    autofocus class="input">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="description" class="label">Deskripsi
                    <span class="font-normal text-slate-400">(opsional)</span></label>
                <textarea id="description" name="description" rows="4"
                    class="input resize-none">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-200 pt-5">
                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                <a href="{{ url('/categories') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

        <aside class="space-y-4">
            <div class="card p-5">
                <h3 class="text-sm font-semibold text-slate-900">Informasi kategori</h3>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">Dibuat</dt>
                        <dd class="font-medium text-slate-800">{{ $category->created_at?->format('d M Y H:i') }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-500">Terakhir diubah</dt>
                        <dd class="font-medium text-slate-800">{{ $category->updated_at?->format('d M Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-rose-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-rose-700">Hapus kategori</h3>
                <p class="mt-1.5 text-xs leading-relaxed text-slate-500">
                    Kategori yang dihapus tidak dapat dikembalikan.
                </p>
                <form method="POST" action="{{ url('/categories/' . $category->id) }}" class="mt-4"
                    onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-full">Hapus kategori</button>
                </form>
            </div>
        </aside>
    </div>
</x-app-layout>

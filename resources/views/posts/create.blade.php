<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tambah Post</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">
        <div class="mx-auto max-w-3xl px-4 py-12">
            <div class="mb-8 flex items-center justify-between">
                <h1 class="text-3xl font-bold">Tambah Post</h1>

                <a href="/posts" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    &larr; Kembali
                </a>
            </div>

            <form action="/posts" method="POST" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
                @csrf

                <div>
                    <label for="title" class="mb-2 block text-sm font-medium">Judul</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-900 focus:outline-none"
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="mb-2 block text-sm font-medium">Isi</label>
                    <textarea
                        name="body"
                        id="body"
                        rows="8"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-900 focus:outline-none"
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700"
                >
                    Simpan
                </button>
            </form>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Config</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">
        <div class="mx-auto max-w-3xl px-4 py-12">
            <div class="mb-8 flex items-center justify-between">
                <h1 class="text-3xl font-bold">Config</h1>

                <a href="/posts" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    &larr; Kembali
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/config" method="POST" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
                @csrf

                <div>
                    <label for="site_name" class="mb-2 block text-sm font-medium">Nama Situs</label>
                    <input
                        type="text"
                        name="site_name"
                        id="site_name"
                        value="{{ old('site_name', $settings['site_name']) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-900 focus:outline-none"
                    >
                    @error('site_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_description" class="mb-2 block text-sm font-medium">Deskripsi</label>
                    <input
                        type="text"
                        name="site_description"
                        id="site_description"
                        value="{{ old('site_description', $settings['site_description']) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-900 focus:outline-none"
                    >
                    @error('site_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_email" class="mb-2 block text-sm font-medium">Email Kontak</label>
                    <input
                        type="email"
                        name="contact_email"
                        id="contact_email"
                        value="{{ old('contact_email', $settings['contact_email']) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-900 focus:outline-none"
                    >
                    @error('contact_email')
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

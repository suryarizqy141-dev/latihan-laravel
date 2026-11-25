<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Posts</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">
        <div class="mx-auto max-w-3xl px-4 py-12">
            <div class="mb-8 flex items-center justify-between">
                <h1 class="text-3xl font-bold">Posts</h1>

                <div class="flex items-center gap-3">
                    <a
                        href="/config"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Config
                    </a>

                    <a
                        href="/posts/create"
                        class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700"
                    >
                        Tambah Post
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($posts->isEmpty())
                <p class="rounded-lg border border-dashed border-gray-300 p-8 text-center text-gray-500">
                    Belum ada post.
                </p>
            @else
                <div class="space-y-4">
                    @foreach ($posts as $post)
                        <article class="rounded-lg bg-white p-6 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>

                                <form action="/posts/{{ $post->id }}" method="POST" onsubmit="return confirm('Hapus post ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-800"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            <p class="mt-2 whitespace-pre-line text-gray-700">{{ $post->body }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </body>
</html>

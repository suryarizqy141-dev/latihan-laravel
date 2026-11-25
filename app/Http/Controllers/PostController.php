<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ], [
            'title.required' => 'Judul post wajib diisi.',
            'body.required' => 'Isi post wajib diisi.',
        ]);

        $validated['content'] = $validated['body'];

        Post::create($validated);

        return $this->redirectAfter($request, 'Post berhasil ditambahkan.');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ], [
            'title.required' => 'Judul post wajib diisi.',
            'body.required' => 'Isi post wajib diisi.',
        ]);

        $validated['content'] = $validated['body'];

        $post->update($validated);

        return $this->redirectAfter($request, 'Post berhasil diperbarui.');
    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();

        return $this->redirectAfter($request, 'Post berhasil dihapus.');
    }

    private function redirectAfter(Request $request, string $message)
    {
        $url = $request->input('from') === 'dashboard'
            ? url('/dashboard') . '?tab=posts'
            : url('/posts');

        return redirect($url)->with('success', $message);
    }
}

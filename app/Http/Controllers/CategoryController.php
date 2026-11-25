<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->trim()->toString();

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $total = Category::count();

        return view('category.index', compact('categories', 'search', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
        ]);

        Category::create($validated);

        return $this->redirectAfter($request, 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
        ]);

        $category->update($validated);

        return $this->redirectAfter($request, 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        return $this->redirectAfter($request, 'Kategori berhasil dihapus.');
    }

    private function redirectAfter(Request $request, string $message)
    {
        $url = $request->input('from') === 'dashboard'
            ? url('/dashboard') . '?tab=categories'
            : url('/categories');

        return redirect($url)->with('success', $message);
    }
}

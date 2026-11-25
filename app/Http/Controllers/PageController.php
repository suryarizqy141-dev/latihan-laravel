<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard(Request $request)
    {
        $tabs = ['users', 'categories', 'posts'];
        $activeTab = $request->input('tab', 'users');

        if (!in_array($activeTab, $tabs, true)) {
            $activeTab = 'users';
        }

        $search = trim((string) $request->input('q', ''));
        $editId = $request->integer('edit');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6, ['*'], 'users_page')
            ->withQueryString();

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6, ['*'], 'categories_page')
            ->withQueryString();

        $posts = Post::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6, ['*'], 'posts_page')
            ->withQueryString();

        $stats = [
            'users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
            'categories' => Category::count(),
            'posts' => Post::count(),
        ];

        $editUser = $activeTab === 'users' && $editId
            ? User::find($editId)
            : null;
        $editCategory = $activeTab === 'categories' && $editId
            ? Category::find($editId)
            : null;
        $editPost = $activeTab === 'posts' && $editId
            ? Post::find($editId)
            : null;

        return view('dashboard', compact(
            'tabs',
            'activeTab',
            'search',
            'users',
            'categories',
            'posts',
            'stats',
            'editUser',
            'editCategory',
            'editPost',
        ));
    }

    public function admin()
    {
        $stats = [
            'users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
            'categories' => Category::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();

        return view('admin', compact('stats', 'recentUsers'));
    }
}

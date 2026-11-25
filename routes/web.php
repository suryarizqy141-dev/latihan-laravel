<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Modul Praktikum Laravel 8 Bagian 1 - 7)
| Disesuaikan untuk Laravel 12 & PHP 8.3
|--------------------------------------------------------------------------
*/

// Beranda Navigasi Praktikum
Route::get('/', function () {
    return view('welcome_modul');
});

// ==========================================
// BAGIAN 1: Route dan View Sederhana
// ==========================================
Route::get('/hello', function () {
    return view('hello');
});

// ==========================================
// BAGIAN 2: Controller dan Route
// ==========================================
Route::get('/home', [PageController::class, 'home']);

// ==========================================
// BAGIAN 3: Database, Eloquent & Latihan Kategori
// ==========================================
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

// ==========================================
// BAGIAN 4: Form dan Validasi
// ==========================================
Route::get('/user', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);

// ==========================================
// BAGIAN 5: CRUD Dasar (Create, Read, Update, Delete)
// ==========================================
// Tampilkan semua user
Route::get('/users', [UserController::class, 'index']);
// Form edit user
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
// Proses update user
Route::post('/user/update/{id}', [UserController::class, 'update']);
// Hapus user
Route::delete('/user/{id}', [UserController::class, 'destroy']);

// ==========================================
// BAGIAN 6: Authentication dan Authorization
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman khusus user yang sudah login
Route::get('/dashboard', [PageController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Halaman khusus role admin (Latihan Bagian 6)
Route::get('/admin', [PageController::class, 'admin'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin');

// ==========================================
// CRUD Post (digabung ke dashboard)
// ==========================================
Route::get('/posts', function () {
    return redirect('/dashboard?tab=posts');
})->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// ==========================================
// BAGIAN 7: Pengujian Front-End Form API
// ==========================================
Route::get('/api-test', function () {
    return view('api-test');
});

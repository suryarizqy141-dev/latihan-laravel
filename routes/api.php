<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 2. Pembuatan API Login (Bagian 7)
Route::post('/login', [AuthController::class, 'login']);

// 3. & 4. CRUD User oleh Admin (Perbedaan Akses User)
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::apiResource('/users', UserController::class);
});

// User dapat update data sendiri & cek data user
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/profile', [ProfileController::class, 'update']);
});

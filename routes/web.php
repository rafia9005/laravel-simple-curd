<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserEditController;


Route::get('/', [HomeController::class, 'index']);
// login & register
Route::get('/login', [AuthController::class, 'indexLogin']);
Route::get('/register', [AuthController::class, 'indexRegister']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/image/update', [ProfileController::class, 'profileImageUpdate'])->name('profile.image.update');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    });
    // admin only
    Route::middleware(['admin'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/edit/{id}', [UserEditController::class, 'editUser'])->name('user.edit');
            Route::post('/update/{id}', [UserEditController::class, 'updateUser'])->name('user.update');
            Route::delete('/delete/{id}', [UserEditController::class, 'deleteUser'])->name('user.delete');
        });
    });
});
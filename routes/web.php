<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Guest;
use App\Http\Middleware\User;
use App\Http\Middleware\UserTerverifikasi;
use App\Http\Middleware\Admin;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['throttle:60,1'])->group(function() {
    Route::middleware([Guest::class])->group(function () {
        Route::get('/', [GuestController::class, 'index'])->name('index');
        Route::get('/login', [UserAuthController::class, 'viewLogin'])->name('view-login');
        Route::post('/login', [UserAuthController::class, 'login'])->name('login');
        Route::get('/register', [UserAuthController::class, 'viewRegister'])->name('view-register');
        Route::post('/register', [UserAuthController::class, 'register'])->name('register');
        Route::get('/admin/login', [AdminAuthController::class, 'viewLogin'])->name('admin-view-login');
        Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin-login');
    });
    
    Route::middleware([User::class])->group(function () {
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [UserAuthController::class, 'viewDashboard'])->name('view-dashboard');
        Route::get('/verifikasi', [UserAuthController::class, 'viewVerifikasi'])->name('view-verifikasi');
        Route::post('/verifikasi', [UserAuthController::class, 'verifikasi'])->name('verifikasi');
        Route::get('/profile', [UserAuthController::class, 'viewProfile'])->name('view-profile');
        Route::post('/profile', [UserAuthController::class, 'profile'])->name('profile');
    });

    Route::middleware([UserTerverifikasi::class])->group(function () {
        Route::get('/dashboard', [UserAuthController::class, 'viewDashboard'])->name('view-dashboard');
    });
    
    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        Route::get('/admin/dashboard', [AdminAuthController::class, 'viewDashboard'])->name('admin-view-dashboard');
        Route::get('/admin/profile', [AdminAuthController::class, 'viewProfile'])->name('admin-view-profile');
        Route::post('/admin/profile', [AdminAuthController::class, 'profile'])->name('admin-profile');
    });
});
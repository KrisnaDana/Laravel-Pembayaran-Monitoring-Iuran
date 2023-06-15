<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Guest;
use App\Http\Middleware\User;
use App\Http\Middleware\UserTerverifikasi;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Master;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MasterKelolaAkunAdminController;
use App\Http\Controllers\AdminKelolaAkunUserController;
use App\Http\Controllers\AdminIuranController;
use App\Http\Controllers\AdminAlokasiController;
use App\Http\Controllers\AdminPeriodeController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\UserIuranController;
use App\Http\Controllers\UserPembayaranController;

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

        // User Iuran
        Route::get('/user/iuran', [UserIuranController::class, 'viewIuran'])->name('user-view-iuran');
        Route::get('/user/create-iuran', [UserIuranController::class, 'createIuran'])->name('user-create-iuran');
        Route::post('/user/store-iuran', [UserIuranController::class, 'storeIuran'])->name('user-store-iuran');
        Route::get('/user/edit-iuran-{id}', [UserIuranController::class, 'editIuran'])->name('user-edit-iuran');
        Route::get('/user/preview-iuran-{id}', [UserIuranController::class, 'previewIuran'])->name('user-preview-iuran');
        Route::post('/user/update-iuran-{id}', [UserIuranController::class, 'updateIuran'])->name('user-update-iuran');
        Route::get('/user/delete-iuran-{id}', [UserIuranController::class, 'deleteIuran'])->name('user-delete-iuran');
    });
    
    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        Route::get('/admin/dashboard', [AdminAuthController::class, 'viewDashboard'])->name('admin-view-dashboard');
        Route::get('/admin/profile', [AdminAuthController::class, 'viewProfile'])->name('admin-view-profile');
        Route::post('/admin/profile', [AdminAuthController::class, 'profile'])->name('admin-profile');

        // Admin Iuran
        Route::get('/admin/iuran', [AdminIuranController::class, 'viewIuran'])->name('admin-view-iuran');
        Route::get('/admin/create-iuran', [AdminIuranController::class, 'createIuran'])->name('admin-create-iuran');
        Route::post('/admin/store-iuran', [AdminIuranController::class, 'storeIuran'])->name('admin-store-iuran');
        Route::get('/admin/edit-iuran-{id}', [AdminIuranController::class, 'editIuran'])->name('admin-edit-iuran');
        Route::get('/admin/preview-iuran-{id}', [AdminIuranController::class, 'previewIuran'])->name('admin-preview-iuran');
        Route::post('/admin/update-iuran-{id}', [AdminIuranController::class, 'updateIuran'])->name('admin-update-iuran');
        Route::get('/admin/delete-iuran-{id}', [AdminIuranController::class, 'deleteIuran'])->name('admin-delete-iuran');
    });
    
    Route::middleware([Master::class])->group(function () {
        //
    });
});
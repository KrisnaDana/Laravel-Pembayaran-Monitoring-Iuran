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
    });
    
    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        Route::get('/admin/dashboard', [AdminAuthController::class, 'viewDashboard'])->name('admin-view-dashboard');
        Route::get('/admin/profile', [AdminAuthController::class, 'viewProfile'])->name('admin-view-profile');
        Route::post('/admin/profile', [AdminAuthController::class, 'profile'])->name('admin-profile');

        // Admin Iuran
        Route::get('/admin/iuran', [AdminIuranController::class, 'viewIuran'])->name('admin-view-iuran');
        Route::get('/admin/create-iuran', [AdminIuranController::class, 'createIuran'])->name('admin-create-iuran');

        // Pembayaran
        Route::get('/admin/pembayaran-pilih-iuran', [AdminPembayaranController::class, 'pilihIuran'])->name('admin-view-pembayaran-pilih-iuran');
        Route::get('/admin/pembayaran/{id}', [AdminPembayaranController::class, 'index'])->name('admin-view-pembayaran');
        Route::get('/admin/read-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'read'])->name('admin-read-pembayaran');
        Route::get('/admin/create-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'viewCreate'])->name('admin-view-create-pembayaran');
        Route::post('/admin/create-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'create'])->name('admin-create-pembayaran');
        Route::get('/admin/edit-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'viewEdit'])->name('admin-view-edit-pembayaran');
        Route::post('/admin/edit-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'edit'])->name('admin-edit-pembayaran');
        Route::post('/admin/delete-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'delete'])->name('admin-delete-pembayaran');
        Route::get('/admin/konfirmasi-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'viewKonfirmasi'])->name('admin-view-konfirmasi-pembayaran');
        Route::post('/admin/konfirmasi-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'konfirmasi'])->name('admin-konfirmasi-pembayaran');

        // Periode
        Route::get('/admin/periode-pilih-iuran', [AdminPeriodeController::class, 'pilihIuran'])->name('admin-view-periode-pilih-iuran');
        Route::get('/admin/periode/{id}', [AdminPeriodeController::class, 'index'])->name('admin-view-periode');
        Route::get('/admin/read-periode/{id}-{periode_id}', [AdminPeriodeController::class, 'read'])->name('admin-read-periode');
        Route::get('/admin/create-periode/{id}', [AdminPeriodeController::class, 'viewCreate'])->name('admin-view-create-periode');
        Route::post('/admin/create-periode/{id}', [AdminPeriodeController::class, 'create'])->name('admin-create-periode');
        Route::get('/admin/edit-periode/{id}-{periode_id}', [AdminPeriodeController::class, 'viewEdit'])->name('admin-view-edit-periode');
        Route::post('/admin/edit-periode/{id}-{periode_id}', [AdminPeriodeController::class, 'edit'])->name('admin-edit-periode');
        Route::post('/admin/delete-periode/{id}-{periode_id}', [AdminPeriodeController::class, 'delete'])->name('admin-delete-periode');
    });

    Route::middleware([Master::class])->group(function () {
        //
    });
});
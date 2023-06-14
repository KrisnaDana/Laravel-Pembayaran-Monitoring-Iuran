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

Route::middleware(['throttle:60,1'])->group(function () {
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

        // Admin Kelola User
        Route::get('/admin/list-user', [AdminKelolaAkunUserController::class, 'viewListUser'])->name('admin-view-list-user');
        Route::get('/admin/list-user-detail-{id}', [AdminKelolaAkunUserController::class, 'detailUser'])->name('admin-detail-user');
        Route::get('/admin/list-user-create', [AdminKelolaAkunUserController::class, 'createUser'])->name('admin-create-user');
        Route::post('/admin/list-user-create-submit', [AdminKelolaAkunUserController::class, 'createUserSubmit'])->name('admin-create-user-submit');
        Route::get('/admin/list-user-edit-{id}', [AdminKelolaAkunUserController::class, 'editUSer'])->name('admin-edit-user');
        Route::post('/admin/list-user-edit-submit-{id}', [AdminKelolaAkunUserController::class, 'editUserSubmit'])->name('admin-edit-user-submit');
        Route::delete('/admin/list-user-delete-foto-user-{id}', [AdminKelolaAkunUserController::class, 'deleteFotoUser'])->name('admin-delete-foto-user');
        Route::delete('/admin/list-user-delete-{id}', [AdminKelolaAkunUserController::class, 'deleteUser'])->name('admin-delete-user');
    });

    Route::middleware([Master::class])->group(function () {
        // Kelola Admin
        Route::get('/admin/master/list-admin', [MasterKelolaAkunAdminController::class, 'viewListAdmin'])->name('admin-master-view-list-admin');
        Route::get('/admin/master/list-admin-create', [MasterKelolaAkunAdminController::class, 'createAdmin'])->name('admin-master-create-admin');
        Route::get('/admin/master/list-admin-detail-{id}', [MasterKelolaAkunAdminController::class, 'detailAdmin'])->name('admin-master-detail-admin');
        Route::post('/admin/master/list-admin-create-submit', [MasterKelolaAkunAdminController::class, 'createAdminSubmit'])->name('admin-master-create-admin-submit');
        Route::get('/admin/master/list-admin-edit-{id}', [MasterKelolaAkunAdminController::class, 'editAdmin'])->name('admin-master-edit-admin');
        Route::post('/admin/master/list-admin-edit-submit-{id}', [MasterKelolaAkunAdminController::class, 'editAdminSubmit'])->name('admin-master-edit-admin-submit');
        Route::delete('/admin/master/list-admin-delete-{id}', [MasterKelolaAkunAdminController::class, 'deleteAdmin'])->name('admin-master-delete-admin');

        // Kelola User
        Route::get('/admin/master/list-user', [MasterKelolaAkunAdminController::class, 'viewListUser'])->name('admin-master-view-list-user');
        Route::get('/admin/master/list-user-detail-{id}', [MasterKelolaAkunAdminController::class, 'detailUser'])->name('admin-master-detail-user');
        Route::get('/admin/master/list-user-create', [MasterKelolaAkunAdminController::class, 'createUser'])->name('admin-master-create-user');
        Route::post('/admin/master/list-user-create-submit', [MasterKelolaAkunAdminController::class, 'createUserSubmit'])->name('admin-master-create-user-submit');
        Route::get('/admin/master/list-user-edit-{id}', [MasterKelolaAkunAdminController::class, 'editUSer'])->name('admin-master-edit-user');
        Route::post('/admin/master/list-user-edit-submit-{id}', [MasterKelolaAkunAdminController::class, 'editUserSubmit'])->name('admin-master-edit-user-submit');
        Route::delete('/admin/master/list-user-delete-foto-user-{id}', [MasterKelolaAkunAdminController::class, 'deleteFotoUser'])->name('admin-master-delete-foto-user');
        Route::delete('/admin/master/list-user-delete-{id}', [MasterKelolaAkunAdminController::class, 'deleteUser'])->name('admin-master-delete-user');
    });
});

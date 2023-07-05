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

        // Admin Kelola User
        Route::get('/admin/list-user', [AdminKelolaAkunUserController::class, 'viewListUser'])->name('admin-view-list-user');
        Route::get('/admin/list-user-detail-{id}', [AdminKelolaAkunUserController::class, 'detailUser'])->name('admin-detail-user');
        Route::get('/admin/list-user-create', [AdminKelolaAkunUserController::class, 'createUser'])->name('admin-create-user');
        Route::post('/admin/list-user-create-submit', [AdminKelolaAkunUserController::class, 'createUserSubmit'])->name('admin-create-user-submit');
        Route::get('/admin/list-user-edit-{id}', [AdminKelolaAkunUserController::class, 'editUSer'])->name('admin-edit-user');
        Route::post('/admin/list-user-edit-submit-{id}', [AdminKelolaAkunUserController::class, 'editUserSubmit'])->name('admin-edit-user-submit');
        Route::delete('/admin/list-user-delete-foto-user-{id}', [AdminKelolaAkunUserController::class, 'deleteFotoUser'])->name('admin-delete-foto-user');
        Route::delete('/admin/list-user-delete-{id}', [AdminKelolaAkunUserController::class, 'deleteUser'])->name('admin-delete-user');

        // Admin Verifikasi User
        Route::get('/admin/list-verifikasi-user', [AdminKelolaAkunUserController::class, 'viewListUserVerifikasi'])->name('admin-view-list-verifikasi-user');
        Route::get('/admin/list-verifikasi-user-detail-{id}', [AdminKelolaAkunUserController::class, 'detailVerifikasiUser'])->name('admin-detail-verifikasi-user');
        Route::post('/admin/list-verifikasi-user-detail-submit-{id}', [AdminKelolaAkunUserController::class, 'detailtVerifikasiUserSubmit'])->name('admin-detail-verifikasi-user-submit');
        Route::post('/admin/list-verifikasi-user-detail-revisi-submit-{id}', [AdminKelolaAkunUserController::class, 'detailtVerifikasiUserRevisiSubmit'])->name('admin-detail-verifikasi-user-revisi-submit');
        Route::get('/admin/list-verifikasi-user-edit-{id}', [AdminKelolaAkunUserController::class, 'editVerifikasiUser'])->name('admin-edit-verifikasi-user');
        Route::post('/admin/list-verifikasi-user-edit-submit-{id}', [AdminKelolaAkunUserController::class, 'editVerifikasiUserSubmit'])->name('admin-edit-verifikasi-user-submit');
        Route::delete('/admin/list-verifikasi-user-delete-{id}', [AdminKelolaAkunUserController::class, 'deleteVerifikasiUser'])->name('admin-delete-verifikasi-user');

        //Alokasi
        Route::get('/admin/alokasi', [AdminAlokasiController::class, 'previewIuran'])->name('admin-preview-alokasi');
        Route::get('/admin/alokasi/{id}', [AdminAlokasiController::class, 'viewAlokasi'])->name('admin-view-alokasi');
        Route::get('/admin/detail-alokasi/{iuranId}-{alokasiId}', [AdminAlokasiController::class, 'detailAlokasi'])->name('admin-detail-alokasi');
        Route::get('/admin/edit-alokasi/{iuranId}-{alokasiId}', [AdminAlokasiController::class, 'editAlokasi'])->name('admin-edit-alokasi');
        Route::put('/admin/edit-alokasi/{iuranId}-{alokasiId}', [AdminAlokasiController::class, 'updateAlokasi'])->name('admin-update-alokasi');
        Route::delete('/admin/delete-alokasi/{iuranId}-{alokasiId}', [AdminAlokasiController::class, 'deleteAlokasi'])->name('admin-delete-alokasi');
        Route::get('/admin/create-alokasi/{id}', [AdminAlokasiController::class, 'createAlokasi'])->name('admin-create-alokasi');
        Route::post('/admin/create-alokasi/{id}', [AdminAlokasiController::class, 'storeAlokasi'])->name('admin-create-alokasi-store');

        // Pembayaran
        Route::get('/admin/pembayaran-pilih-iuran', [AdminPembayaranController::class, 'pilihIuran'])->name('admin-view-pembayaran-pilih-iuran');
        Route::get('/admin/pembayaran/{id}', [AdminPembayaranController::class, 'index'])->name('admin-view-pembayaran');
        Route::get('/admin/read-pembayaran/{id}-{pembayaran_id}', [AdminPembayaranController::class, 'read'])->name('admin-read-pembayaran');
        Route::get('/admin/create-pembayaran/{id}', [AdminPembayaranController::class, 'viewCreate'])->name('admin-view-create-pembayaran');
        Route::post('/admin/create-pembayaran/{id}', [AdminPembayaranController::class, 'create'])->name('admin-create-pembayaran');
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

        // Verifikasi User
        Route::get('/admin/master/list-verifikasi-user', [MasterKelolaAkunAdminController::class, 'viewListUserVerifikasi'])->name('admin-master-view-list-verifikasi-user');
        Route::get('/admin/master/list-verifikasi-user-detail-{id}', [MasterKelolaAkunAdminController::class, 'detailVerifikasiUser'])->name('admin-master-detail-verifikasi-user');
        Route::post('/admin/master/list-verifikasi-user-detail-submit-{id}', [MasterKelolaAkunAdminController::class, 'detailtVerifikasiUserSubmit'])->name('admin-master-detail-verifikasi-user-submit');
        Route::post('/admin/master/list-verifikasi-user-detail-revisi-submit-{id}', [MasterKelolaAkunAdminController::class, 'detailtVerifikasiUserRevisiSubmit'])->name('admin-master-detail-verifikasi-user-revisi-submit');
        Route::get('/admin/master/list-verifikasi-user-edit-{id}', [MasterKelolaAkunAdminController::class, 'editVerifikasiUser'])->name('admin-master-edit-verifikasi-user');
        Route::post('/admin/master/list-verifikasi-user-edit-submit-{id}', [MasterKelolaAkunAdminController::class, 'editVerifikasiUserSubmit'])->name('admin-master-edit-verifikasi-user-submit');
        Route::delete('/admin/master/list-verifikasi-user-delete-{id}', [MasterKelolaAkunAdminController::class, 'deleteVerifikasiUser'])->name('admin-master-delete-verifikasi-user');
    });
});

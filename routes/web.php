<?php

use App\Http\Controllers\PengaduansaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PengaduanUserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\JumlahDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;


// Default halaman awal untuk siswa/orangtua

Route::get('/', [PengaduansaranController::class, 'welcome'])->name('welcome');


// ===========================
// AUTH ROUTES
// ===========================
Auth::routes();

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===========================
// ROUTE ADMIN
// ===========================
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    Route::get('/admin', [DashboardController::class, 'admin'])->name('index');


    // ===========================
    // AKUN ORANGTUA (ADMIN)
    // ===========================
    Route::get('/admin/orangtua', [UserController::class, 'index'])->name('orangtua.index');
    Route::get('/admin/orangtua/create', [UserController::class, 'create'])->name('orangtua.create');
    Route::post('/admin/orangtua/store', [UserController::class, 'store'])->name('orangtua.store');
    Route::get('/admin/orangtua/{id}/edit', [UserController::class, 'edit'])->name('orangtua.edit');
    Route::put('/admin/orangtua/{id}', [UserController::class, 'update'])->name('orangtua.update');
    Route::post('/admin/orangtua/import', [UserController::class, 'import'])->name('orangtua.import');
    Route::get('/admin/orangtua/template', [UserController::class, 'template'])->name('orangtua.template');
    Route::delete('/admin/orangtua/{id}', [UserController::class, 'destroy'])->name('orangtua.destroy');


    // ===========================
    // AKUN SISWA (ADMIN)
    // ===========================
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/admin/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/admin/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::post('/admin/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::get('/admin/siswa/template', [SiswaController::class, 'template'])->name('siswa.template');
    Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');


    // ===========================
    // CUSTOM ROUTE TANGGAPAN
    // ===========================
    Route::get('tanggapan/{id}/tanggapi', [TanggapanController::class, 'formTanggapi'])->name('tanggapan.tanggapi');
    Route::post('tanggapan/{id}/kirim', [TanggapanController::class, 'submitTanggapi'])->name('tanggapan.kirim');


    // ===========================
    // RESOURCE ADMIN
    // ===========================
    Route::resource('tanggapan', TanggapanController::class)->names('tanggapan');

    Route::resource('riwayat', RiwayatController::class);

    Route::resource('data-orangtua', OrangtuaController::class);

    Route::resource('pengaduansaran', PengaduansaranController::class);

});


// ===========================
// ROUTE SISWA & ORANGTUA (FRONT)
// ===========================
Route::middleware(['auth', 'role:siswa,orangtua'])->group(function () {

    Route::get('/laporan', [FrontController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/create', [PengaduanUserController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [PengaduanUserController::class, 'store'])->name('laporan.store');

    Route::get('/laporan/{laporan}', [FrontController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/detail', [PengaduansaranController::class, 'detail'])->name('laporan.detail');

    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::post('/pengaduansaran/{id}/rating', [PengaduansaranController::class, 'simpanRating'])->name('pengaduansaran.rating');

});


// ===========================
// ROUTE HALAMAN SISWA & ORANGTUA
// ===========================
Route::middleware(['auth', 'role:siswa'])->get('/siswa', [FrontController::class, 'index'])->name('siswa.index');

Route::middleware(['auth', 'role:orangtua'])->get('/orangtua', [FrontController::class, 'index'])->name('orangtua.index');


// ===========================
// JUMLAH DATA
// ===========================
Route::get('/jumlah-data', [JumlahDataController::class, 'index'])->name('jumlahdata.index');

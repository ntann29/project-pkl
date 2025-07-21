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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JumlahDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

// Default halaman awal untuk siswa/orangtua
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PengaduansaranController::class, 'welcome'])->name('welcome');


// Auth bawaan Laravel
Auth::routes();

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    Route::get('/admin', [DashboardController::class, 'admin'])->name('index');

    // ⛳ Custom route HARUS di atas resource
    Route::get('tanggapan/{id}/tanggapi', [TanggapanController::class, 'formTanggapi'])->name('tanggapan.tanggapi');
    Route::post('tanggapan/{id}/kirim', [TanggapanController::class, 'submitTanggapi'])->name('tanggapan.kirim');

    // Setelah itu resource
    Route::resource('tanggapan', TanggapanController::class)->names('tanggapan');

    Route::resource('riwayat', RiwayatController::class);
    Route::resource('data-orangtua', OrangtuaController::class);
    Route::resource('data-siswa', SiswaController::class);
    Route::resource('pengaduansaran', PengaduansaranController::class);
});

Route::middleware(['auth', 'role:siswa,orangtua'])->group(function () {
    Route::get('/laporan', [FrontController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/create', [PengaduanUserController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [PengaduanUserController::class, 'store'])->name('laporan.store');

    Route::get('/laporan/{laporan}', [FrontController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/detail', [PengaduansaranController::class, 'detail'])->name('laporan.detail');

    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::post('/pengaduansaran/{id}/rating', [PengaduansaranController::class, 'simpanRating'])->name('pengaduansaran.rating');
});

Route::middleware(['auth', 'role:siswa'])->get('/siswa', [FrontController::class, 'index'])->name('siswa.index');
Route::middleware(['auth', 'role:orangtua'])->get('/orangtua', [FrontController::class, 'index'])->name('orangtua.index');

Route::get('/jumlah-data', [JumlahDataController::class, 'index'])->name('jumlahdata.index');
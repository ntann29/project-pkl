<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PengaduanSaranController;

// LOGIN
Route::post('/login', [AuthController::class, 'login']);

// ROUTE YANG BUTUH LOGIN
Route::middleware('auth:sanctum')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);

    // USER LOGIN
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // PROFILE 🔥
    Route::get('/profile', function (Request $request) {

        $user = User::with('siswa')->find($request->user()->id);

        return response()->json([
            'data' => $user
        ]);
    });

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // 🔥 PENGADUAN SARAN
    Route::get('/pengaduansaran', [PengaduanSaranController::class, 'index']);
    Route::post('/pengaduansaran', [PengaduansaranController::class, 'store']);

});
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengaduanSaran;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengaduan = PengaduanSaran::count();
        $tanggapan = Tanggapan::count();

        return response()->json([
            "status" => true,
            "pengaduan" => $pengaduan,
            "tanggapan" => $tanggapan
        ]);
    }
}
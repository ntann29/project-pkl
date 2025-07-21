<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JumlahDataController extends Controller
{
    public function index()
    {
        $jumlahPengaduan = DB::table('pengaduansarans')
            ->where('jenis', 'pengaduan')
            ->count();

        $jumlahSaran = DB::table('pengaduansarans')
            ->where('jenis', 'saran')
            ->count();

        return view('jumlahdata', compact('jumlahPengaduan', 'jumlahSaran'));
    }
}
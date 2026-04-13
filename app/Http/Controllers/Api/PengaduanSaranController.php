<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengaduanSaran;
use Illuminate\Http\Request;

class PengaduanSaranController extends Controller
{
    public function index()
    {
        $data = PengaduanSaran::all();

        return response()->json([
            "status" => true,
            "message" => "Data pengaduan saran",
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = Pengaduansaran::create([
            'status_user' => auth()->user()->role,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status' => 'proses',
            'id_user' => auth()->id()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pengaduan berhasil dikirim',
            'data' => $data
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = \App\Models\Riwayat::with(['pengaduansaran', 'user'])
            ->whereHas('pengaduansaran', function ($query) {
                $query->whereIn('status', ['selesai', 'ditanggapi']);
            })
            ->latest()
            ->get();

        return view('admin.riwayat.index', compact('riwayat'));
    }


    // Di akhir fungsi submitTanggapi()

    // Tambahan jika kamu ingin menyimpan riwayat:
    public function store(Request $request)
    {
        Riwayat::create([
            'id_pengaduansaran' => $request->id_pengaduansaran,
            'aksi' => $request->aksi,
            'waktu' => now(),
        ]);

        return redirect()->route('admin.riwayat.index')->with('success', 'Riwayat ditambahkan.');
    }
}

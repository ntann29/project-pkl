<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Pengaduansaran;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([            
            'id_pengaduansaran' => 'required|exists:pengaduansarans,id',
            'isi_komentar' => 'required|string',
        ]);

        $pengaduansaran = Pengaduansaran::findOrFail($request->id_pengaduansaran);

        if (!is_null($pengaduansaran->rating)) {
            return back()->with('error', 'Anda sudah memberi rating, tidak bisa kirim komentar lagi.');
        }

        // Ambil user ID dari session login
        $userId = auth()->id();

        Komentar::create([
            'id_user' => $userId,
            'id_pengaduansaran' => $request->id_pengaduansaran,
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komentar $komentar)
    {
        //
    }
}

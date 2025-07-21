<?php
namespace App\Http\Controllers;

use App\Models\Pengaduansaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanUserController extends Controller
{
    public function create()
    {
        return view('user.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'      => 'required|in:saran,pengaduan',
            'kategori'   => 'required|in:fasilitas,akademik,sarana_sekolah',
            'deskripsi'  => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->kategori === 'pengaduan' && ! $request->hasFile('foto_bukti')) {
            return redirect()->back()->with('error', 'Foto wajib untuk pengaduan.');
        }

        $user        = auth()->user();
        $status_user = $user->role ?? 'user';

        $foto = null;
        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti')->store('pengaduansarans', 'public');
        }

        Pengaduansaran::create([
            'jenis'       => $request->jenis,
            'kategori'    => $request->kategori,
            'deskripsi'   => $request->deskripsi,
            'foto_bukti'  => $foto,
            'status_user' => $status_user,
            'status'      => 'proses',
            'id_user'     => $user->id,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim.');
    }
    public function detail($id)
    {
        $pengaduan = \App\Models\Pengaduansaran::with('user')->findOrFail($id);

        if (auth()->id() !== $pengaduan->id_user) {
            abort(403, 'Akses ditolak');
        }

        return view('user.laporan.detail', compact('pengaduansaran'));
    }

}

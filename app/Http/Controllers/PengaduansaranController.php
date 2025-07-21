<?php

namespace App\Http\Controllers;

use App\Models\Pengaduansaran;
use Illuminate\Http\Request;

class PengaduansaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduansaran = Pengaduansaran::with('user')->latest()->get();
        return view('admin.pengaduansaran.index', compact('pengaduansaran'));
    }

    public function welcome()
    {
        $pengaduansarans = Pengaduansaran::with('user')->latest()->get();
        return view('welcome', compact('pengaduansarans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengaduansaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
        return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        $request->validate([
            'jenis' => 'required|in:saran,pengaduan',
            'kategori' => 'required|in:fasilitas,akademik,sarana_sekolah',
            'deskripsi' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika pengaduan, wajib ada foto
        if ($request->kategori === 'pengaduan' && !$request->hasFile('foto_bukti')) {
            return redirect()->back()->with('error', 'Foto bukti wajib diisi untuk kategori pengaduan.');
        }

        // Cek status user otomatis (dari role login misalnya)
        $user = auth()->user();
        $status_user = 'user'; // default
        if ($user->role === 'siswa') {
            $status_user = 'siswa';
        } elseif ($user->role === 'ortu') {
            $status_user = 'ortu';
        } elseif ($user->role === 'admin') {
            $status_user = 'admin';
        }

        // Upload foto jika ada
        $fotoBukti = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoBukti = $request->file('foto_bukti')->store('pengaduansarans', 'public');
        }

        $pengaduansaran = new Pengaduansaran();
        $pengaduansaran->status_user = $status_user;
        $pengaduansaran->jenis = $request->jenis;
        $pengaduansaran->kategori = $request->kategori;
        $pengaduansaran->deskripsi = $request->deskripsi;
        $pengaduansaran->status = 'proses';
        $pengaduansaran->foto_bukti = $fotoBukti;
        $pengaduansaran->id_user = $user->id;
        $pengaduansaran->save();

        return redirect()->route('admin.pengaduansaran.index')->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $pengaduansaran = \App\Models\Pengaduansaran::with('user', 'tanggapan')->findOrFail($id);        

        if (auth()->id() !== $pengaduansaran->id_user) {
            abort(403, 'Akses ditolak');
        }

        return view('user.laporan.detail', compact('pengaduansaran'));
    }


    public function simpanRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $pengaduansaran = Pengaduansaran::findOrFail($id);

        // Cek apakah user yang sedang login adalah pemiliknya
        if (auth()->id() !== $pengaduansaran->id_user) {
            abort(403, 'Tidak diizinkan memberi rating.');
        }

        // Cek jika rating sudah ada
        if (!is_null($pengaduansaran->rating)) {
            return back()->with('error', 'Anda sudah memberi rating.');
        }

        $pengaduansaran->rating = $request->rating;
        $pengaduansaran->save();

        return back()->with('success', 'Rating berhasil dikirim.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduansaran $pengaduansaran)
    {        
        // Hapus file foto dari storage kalau ada
        if ($pengaduansaran->foto_bukti && \Storage::disk('public')->exists($pengaduansaran->foto_bukti)) {
        \Storage::disk('public')->delete($pengaduansaran->foto_bukti);
        }

        // Hapus data dari database
        $pengaduansaran->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pengaduansaran.index')->with('success', 'Data berhasil dihapus.');
        
    }
}

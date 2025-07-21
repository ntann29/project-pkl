<?php

namespace App\Http\Controllers;

use App\Models\Pengaduansaran;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduansaran = Pengaduansaran::with('tanggapan')->orderBy('created_at', 'desc')->get();
        return view('admin.tanggapan.index', compact('pengaduansaran'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengaduan = Pengaduansaran::where('status', 'proses')->get(); // hanya pengaduan yg masih aktif
        return view('admin.tanggapan.create', compact('pengaduan'));
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $pengaduan = Pengaduansaran::with('user')->findOrFail($id);

        // Pastikan hanya user yang punya laporan itu yang boleh lihat
        if (auth()->id() !== $pengaduan->id_user) {
            abort(403, 'Akses ditolak');
        }

        return view('frontend.laporan.detail', compact('pengaduan'));
    }


    // Form untuk menanggapi pengaduan tertentu
    public function formTanggapi($id)
    {
        $pengaduansaran = Pengaduansaran::findOrFail($id);
        return view('admin.tanggapan.tanggapi', compact('pengaduansaran'));
    }

    // Simpan tanggapan dari form
    public function submitTanggapi(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti')->store('tanggapan', 'public');
        }

        Tanggapan::create([
            'id_pengaduansaran' => $id,
            'isi_tanggapan' => $request->isi_tanggapan,
            'foto_bukti' => $foto,
        ]);

        $pengaduan = Pengaduansaran::find($id);
        $pengaduan->status = 'ditanggapi';
        $pengaduan->save();

        return redirect()->route('admin.pengaduansaran.index')->with('success', 'Pengaduan berhasil ditanggapi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Tanggapan $tanggapan)
    {
        // Hapus file foto jika ada
        if ($tanggapan->foto_bukti && \Storage::disk('public')->exists($tanggapan->foto_bukti)) {
            \Storage::disk('public')->delete($tanggapan->foto_bukti);
        }   

        // Hapus data dari database
        $tanggapan->delete();
        // Redirect kembali ke index dengan pesan sukses
        return redirect()->route('admin.tanggapan.index')->with('success', 'Tanggapan berhasil dihapus.');
    }

}

<?php
namespace App\Http\Controllers;

use App\Models\Pengaduansaran;
use App\Models\Tanggapan;

class DashboardController extends Controller
{
    public function admin()
    {
        // Buat array bulan dan jumlah
        $labels = [];
        $data   = [];

        // Hitung total pengaduan dan tanggapan
        $jumlahPengaduan = Pengaduansaran::count();
        $jumlahTanggapan = Tanggapan::count();

        $jumlahSelesai      = Pengaduansaran::where('status', 'Selesai')->count();
        $jumlahBelumSelesai = Pengaduansaran::where('status', '!=', 'Selesai')->count();

        // Gabungkan semua dalam satu return view
        return view('admin.index', [
            'labels'             => $labels,
            'data'               => $data,
            'jumlahPengaduan'    => $jumlahPengaduan,
            'jumlahTanggapan'    => $jumlahTanggapan,
            'jumlahSelesai'      => $jumlahSelesai,
            'jumlahBelumSelesai' => $jumlahBelumSelesai
        ]);
    }

    public function siswa()
    {
        $pengaduansarans = Pengaduansaran::where('id_user', auth()->id())->latest()->get();
        return view('user.index', compact('pengaduansarans'));
    }

    public function orangtua()
    {
        return view('user.index');
    }
}

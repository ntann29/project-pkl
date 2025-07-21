<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduansaran;

class FrontController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $pengaduansarans = \App\Models\Pengaduansaran::where('id_user', $userId)->latest()->get();

        return view('user.laporan.index', compact('pengaduansarans'));
    }

    
    public function show($id)
    {
        $pengaduan = Pengaduansaran::where('id_user', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        return view('user.show', compact('pengaduan'));
    }

     public function index2()
    {
        $userId = auth()->id();
        $pengaduansarans = \App\Models\Pengaduansaran::where('id_user', $userId)->latest()->get();

        return view('welcome', compact('pengaduansarans'));
    }
}

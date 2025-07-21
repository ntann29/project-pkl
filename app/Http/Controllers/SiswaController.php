<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('user')->get();
        return view('admin.data-siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // untuk memilih user
        return view('admin.data-siswa.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'required|numeric|unique:siswas,nisn', // <-- ubah dari siswa ke siswas
        ]);        

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

        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->nisn = $request->nisn;
        $siswa->id_user = $user->id;
        $siswa->save();

        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('user');
        return view('admin.data-siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $users = User::all();
        return view('admin.data-siswa.edit', compact('siswa', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'required|numeric|unique:siswas,nisn,' . $siswa->id,
            'id_user' => 'required|exists:users,id',
        ]);

        $siswa->update($request->all());

        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        
        $siswa->delete();
        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
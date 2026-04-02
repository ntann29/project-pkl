<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('user')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // ✅ EMAIL MANUAL
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'required|numeric|unique:siswas,nisn',
            'kelas' => 'required|string|max:50',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email, // ✅ ambil dari input
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email, // ✅ simpan juga di tabel siswas
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diimport');
    }

    public function template()
    {
        return Excel::download(new SiswaTemplateExport, 'Data Siswa.xlsx');
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $siswa->id_user, // ✅ biar ga bentrok sama email dia sendiri
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'required|numeric|unique:siswas,nisn,' . $id,
            'kelas' => 'required|string|max:50',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'email' => $request->email, // ✅ update email siswa
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
        ]);

        if ($siswa->user) {
            $siswa->user->update([
                'name' => $request->nama,
                'email' => $request->email, // ✅ update email user juga
            ]);
        }

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diupdate.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        if ($siswa->user) {
            $siswa->user->delete();
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}

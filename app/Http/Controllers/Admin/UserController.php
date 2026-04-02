<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Imports\OrangtuaImport;
use App\Exports\OrangtuaTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // 🔹 TAMPILKAN LIST AKUN ORANG TUA
    public function index()
    {
        $orangtuas = User::where('role', 'orangtua')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.orangtua.index', compact('orangtuas'));
    }

    // 🔹 TAMPILKAN FORM CREATE
    public function create()
    {
        return view('admin.orangtua.create');
    }

    // 🔹 SIMPAN AKUN ORANG TUA
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email',
            'no_hp'  => 'nullable|string|max:20|unique:users,no_hp',
            'alamat' => 'nullable|string|max:255',
        ], [
            'name.required'  => 'Nama orang tua wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email'    => 'Format email tidak valid!',
            'email.unique'   => 'Email sudah terdaftar!',
            'no_hp.unique'   => 'No HP sudah terdaftar!',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'alamat'   => $request->alamat,
            'password' => Hash::make('orangtua123'),
            'role'     => 'orangtua',
        ]);

        return redirect()
            ->route('admin.orangtua.index')
            ->with('success', 'Akun orang tua berhasil dibuat');
    }

    // 🔹 FORM EDIT
    public function edit($id)
    {
        $orangtua = User::findOrFail($id);
        return view('admin.orangtua.edit', compact('orangtua'));
    }

    // 🔹 UPDATE AKUN ORANG TUA
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $id,
            'no_hp'  => 'nullable|string|max:20|unique:users,no_hp,' . $id,
            'alamat' => 'nullable|string|max:255',
        ], [
            'name.required'  => 'Nama orang tua wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email'    => 'Format email tidak valid!',
            'email.unique'   => 'Email sudah terdaftar!',
            'no_hp.unique'   => 'No HP sudah terdaftar!',
        ]);

        $orangtua = User::findOrFail($id);

        $orangtua->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.orangtua.index')
            ->with('success', 'Akun orang tua berhasil diupdate');
    }

    // 🔹 IMPORT AKUN ORANG TUA DARI EXCEL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ], [
            'file.required' => 'File wajib diupload!',
            'file.mimes'    => 'File harus berupa Excel (.xlsx atau .xls)!'
        ]);

        Excel::import(new OrangtuaImport, $request->file('file'));

        return redirect()
            ->route('admin.orangtua.index')
            ->with('success', 'Data orang tua berhasil diimport (data duplikat otomatis dilewati)');
    }

    // 🔹 DOWNLOAD TEMPLATE EXCEL
    public function template()
    {
        return Excel::download(new OrangtuaTemplateExport, 'Data Orang Tua.xlsx');
    }

    // 🔹 HAPUS AKUN ORANG TUA
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('admin.orangtua.index')
            ->with('success', 'Akun orang tua berhasil dihapus');
    }
}

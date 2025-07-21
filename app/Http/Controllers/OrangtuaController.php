<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ortu = Orangtua::with('user')->get();
        return view('admin.data-orangtua.index', compact('ortu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        $siswas = \App\Models\Siswa::all();
        return view('admin.data-orangtua.create', compact('users', 'siswas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_tlp' => 'required|numeric',
            'id_user' => 'required|exists:users,id',
            'id_siswa' => 'required|exists:siswas,id',
        ]);
        
        $orangtua = new Orangtua();
        $orangtua->nama = $request->nama;
        $orangtua->jenis_kelamin = $request->jenis_kelamin;
        $orangtua->no_tlp = $request->no_tlp;
        $orangtua->id_user = $request->id_user;
        $orangtua->id_siswa = $request->id_siswa;
        $orangtua->save();

        return redirect()->route('admin.data-orangtua.index')->with('success', 'Data orangtua berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Orangtua $orangtua)
    {
        //
    }

    public function edit(Orangtua $orangtua)
    {
        $users = \App\Models\User::all();
        $siswas = \App\Models\Siswa::all();
        return view('admin.data-orangtua.edit', compact('orangtua', 'users', 'siswas'));
    }

    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_tlp' => 'required|numeric',
            'id_user' => 'required|exists:users,id',
            'id_siswa' => 'required|exists:siswas,id',
        ]);

        $orangtua->update($request->all());
        return redirect()->route('admin.data-orangtua.index')->with('success', 'Data orangtua berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orangtua $orangtua)
    {
        $orangtua->delete();
        return redirect()->route('admin.data-orangtua.index')->with('success', 'Data orangtua berhasil dihapus.');
    }

}

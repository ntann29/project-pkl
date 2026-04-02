@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Siswa</h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    {{-- ✅ EMAIL MANUAL --}}
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               placeholder="contoh: siswa@gmail.com" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" required>
                    </div>

                    {{-- ✅ Kelas Dropdown --}}
                    <div class="form-group mb-3">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>

                            {{-- X --}}
                            <option value="X RPL 1">X RPL 1</option>
                            <option value="X RPL 2">X RPL 2</option>
                            <option value="X RPL 3">X RPL 3</option>

                            <option value="X TKRO 1">X TKRO 1</option>
                            <option value="X TKRO 2">X TKRO 2</option>
                            <option value="X TKRO 3">X TKRO 3</option>

                            <option value="X TBSM 1">X TBSM 1</option>
                            <option value="X TBSM 2">X TBSM 2</option>
                            <option value="X TBSM 3">X TBSM 3</option>

                            {{-- XI --}}
                            <option value="XI RPL 1">XI RPL 1</option>
                            <option value="XI RPL 2">XI RPL 2</option>
                            <option value="XI RPL 3">XI RPL 3</option>

                            <option value="XI TKRO 1">XI TKRO 1</option>
                            <option value="XI TKRO 2">XI TKRO 2</option>
                            <option value="XI TKRO 3">XI TKRO 3</option>

                            <option value="XI TBSM 1">XI TBSM 1</option>
                            <option value="XI TBSM 2">XI TBSM 2</option>
                            <option value="XI TBSM 3">XI TBSM 3</option>

                            {{-- XII --}}
                            <option value="XII RPL 1">XII RPL 1</option>
                            <option value="XII RPL 2">XII RPL 2</option>
                            <option value="XII RPL 3">XII RPL 3</option>

                            <option value="XII TKRO 1">XII TKRO 1</option>
                            <option value="XII TKRO 2">XII TKRO 2</option>
                            <option value="XII TKRO 3">XII TKRO 3</option>

                            <option value="XII TBSM 1">XII TBSM 1</option>
                            <option value="XII TBSM 2">XII TBSM 2</option>
                            <option value="XII TBSM 3">XII TBSM 3</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

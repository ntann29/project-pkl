@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Siswa</h4>
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

                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama" class="form-control"
                               value="{{ old('nama', $siswa->nama) }}" required>
                    </div>

                    {{-- ✅ EMAIL MANUAL --}}
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $siswa->user->email ?? '') }}"
                               placeholder="contoh: siswa@gmail.com" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control"
                               value="{{ old('nisn', $siswa->nisn) }}" required>
                    </div>

                    {{-- ✅ Tambahin Kelas Dropdown --}}
                    <div class="form-group mb-3">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>

                            {{-- X --}}
                            <option value="X RPL 1" {{ old('kelas', $siswa->kelas) == 'X RPL 1' ? 'selected' : '' }}>X RPL 1</option>
                            <option value="X RPL 2" {{ old('kelas', $siswa->kelas) == 'X RPL 2' ? 'selected' : '' }}>X RPL 2</option>
                            <option value="X RPL 3" {{ old('kelas', $siswa->kelas) == 'X RPL 3' ? 'selected' : '' }}>X RPL 3</option>

                            <option value="X TKRO 1" {{ old('kelas', $siswa->kelas) == 'X TKRO 1' ? 'selected' : '' }}>X TKRO 1</option>
                            <option value="X TKRO 2" {{ old('kelas', $siswa->kelas) == 'X TKRO 2' ? 'selected' : '' }}>X TKRO 2</option>
                            <option value="X TKRO 3" {{ old('kelas', $siswa->kelas) == 'X TKRO 3' ? 'selected' : '' }}>X TKRO 3</option>

                            <option value="X TBSM 1" {{ old('kelas', $siswa->kelas) == 'X TBSM 1' ? 'selected' : '' }}>X TBSM 1</option>
                            <option value="X TBSM 2" {{ old('kelas', $siswa->kelas) == 'X TBSM 2' ? 'selected' : '' }}>X TBSM 2</option>
                            <option value="X TBSM 3" {{ old('kelas', $siswa->kelas) == 'X TBSM 3' ? 'selected' : '' }}>X TBSM 3</option>

                            {{-- XI --}}
                            <option value="XI RPL 1" {{ old('kelas', $siswa->kelas) == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                            <option value="XI RPL 2" {{ old('kelas', $siswa->kelas) == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                            <option value="XI RPL 3" {{ old('kelas', $siswa->kelas) == 'XI RPL 3' ? 'selected' : '' }}>XI RPL 3</option>

                            <option value="XI TKRO 1" {{ old('kelas', $siswa->kelas) == 'XI TKRO 1' ? 'selected' : '' }}>XI TKRO 1</option>
                            <option value="XI TKRO 2" {{ old('kelas', $siswa->kelas) == 'XI TKRO 2' ? 'selected' : '' }}>XI TKRO 2</option>
                            <option value="XI TKRO 3" {{ old('kelas', $siswa->kelas) == 'XI TKRO 3' ? 'selected' : '' }}>XI TKRO 3</option>

                            <option value="XI TBSM 1" {{ old('kelas', $siswa->kelas) == 'XI TBSM 1' ? 'selected' : '' }}>XI TBSM 1</option>
                            <option value="XI TBSM 2" {{ old('kelas', $siswa->kelas) == 'XI TBSM 2' ? 'selected' : '' }}>XI TBSM 2</option>
                            <option value="XI TBSM 3" {{ old('kelas', $siswa->kelas) == 'XI TBSM 3' ? 'selected' : '' }}>XI TBSM 3</option>

                            {{-- XII --}}
                            <option value="XII RPL 1" {{ old('kelas', $siswa->kelas) == 'XII RPL 1' ? 'selected' : '' }}>XII RPL 1</option>
                            <option value="XII RPL 2" {{ old('kelas', $siswa->kelas) == 'XII RPL 2' ? 'selected' : '' }}>XII RPL 2</option>
                            <option value="XII RPL 3" {{ old('kelas', $siswa->kelas) == 'XII RPL 3' ? 'selected' : '' }}>XII RPL 3</option>

                            <option value="XII TKRO 1" {{ old('kelas', $siswa->kelas) == 'XII TKRO 1' ? 'selected' : '' }}>XII TKRO 1</option>
                            <option value="XII TKRO 2" {{ old('kelas', $siswa->kelas) == 'XII TKRO 2' ? 'selected' : '' }}>XII TKRO 2</option>
                            <option value="XII TKRO 3" {{ old('kelas', $siswa->kelas) == 'XII TKRO 3' ? 'selected' : '' }}>XII TKRO 3</option>

                            <option value="XII TBSM 1" {{ old('kelas', $siswa->kelas) == 'XII TBSM 1' ? 'selected' : '' }}>XII TBSM 1</option>
                            <option value="XII TBSM 2" {{ old('kelas', $siswa->kelas) == 'XII TBSM 2' ? 'selected' : '' }}>XII TBSM 2</option>
                            <option value="XII TBSM 3" {{ old('kelas', $siswa->kelas) == 'XII TBSM 3' ? 'selected' : '' }}>XII TBSM 3</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning text-white">
                        Ubah Akun
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

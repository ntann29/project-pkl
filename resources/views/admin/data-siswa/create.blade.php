@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Siswa Baru</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.data-siswa.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="Laki-laki">Laki Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="form-control" required>
                    </div>

                    {{-- Input ID User --}}
                    <div class="form-group">
                        <label for="id_user">Pilih Akun User</label>
                        <select name="id_user" id="id_user" class="form-control" required>
                            <option value="" selected disabled>-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                    <a href="{{ route('admin.data-siswa.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
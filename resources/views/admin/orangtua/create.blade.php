@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Buat Akun Orang Tua</h4>
            </div>

            <div class="card-body">

                {{-- ALERT SUCCESS --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ALERT ERROR VALIDATION --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.orangtua.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Orang Tua</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@orangtua.sch.id" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                    </div>

                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Akun
                    </button>

                    <a href="{{ route('admin.orangtua.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

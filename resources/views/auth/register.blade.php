@extends('layouts.logis')

@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm p-4" style="width: 420px;">
        <h4 class="text-center mb-1">Register</h4>
        <p class="text-center text-muted mb-4">Buat akun baru</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Register</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Sudah punya akun?</a>
            </div>
        </form>
    </div>
</div>
@endsection

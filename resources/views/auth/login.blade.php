@extends('layouts.logis')

@section('content')

<style>
body {
    background: url('/images/bg.jpg') no-repeat center center/cover;
}

.overlay {
    background: rgba(0, 0, 0, 0.5);
    height: 100vh;
}

/* CARD LOGIN */
.login-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 30px;
    width: 380px;
    color: #333;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* TEXT */
.login-card h4 {
    font-weight: 600;
    color: #333;
}

.login-card p {
    font-size: 14px;
    color: #777;
}

/* INPUT */
.form-control {
    background: #f8f9fa;
    border: 1px solid #ddd;
    color: #333;
}

.form-control:focus {
    background: #fff;
    border-color: #6a11cb;
    box-shadow: 0 0 0 2px rgba(106,17,203,0.1);
    color: #000;
}

/* PLACEHOLDER */
.form-control::placeholder {
    color: #999;
}

/* LABEL */
label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
}

/* BUTTON */
.btn-login {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    border: none;
    font-weight: 500;
    color: white;
}

.btn-login:hover {
    opacity: 0.9;
}
</style>

<div class="overlay d-flex justify-content-center align-items-center">
    <div class="login-card shadow">

        <!-- OPTIONAL BRAND -->
        <div class="text-center mb-3">
            <h3 style="font-weight:700; color:#6a11cb;">SuaraKu</h3>
        </div>

        <h4 class="text-center mb-1">Login</h4>
        <p class="text-center mb-4">Layanan Aspirasi & Keluhan Online</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>

                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password" required>

                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-login w-100 mt-2">Login</button>
        </form>

    </div>
</div>

@endsection

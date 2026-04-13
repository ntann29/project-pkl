@extends('layouts.logis')

@section('content')

<style>
body {
    margin: 0;
    height: 100vh;
    font-family: 'Segoe UI', sans-serif;
    overflow: hidden;
}

/* BACKGROUND FOTO KOMPUTER */
.bg-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c') no-repeat center center/cover;
    filter: blur(5px) grayscale(30%);
    transform: scale(1.05);
    z-index: -2;
}

/* OVERLAY ABU */
.bg-overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(40, 40, 40, 0.35);
    z-index: -1;
}

/* CARD */
.login-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 40px;
    width: 380px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    animation: fadeIn 0.6s ease;
}

/* ANIMATION */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* TEXT */
.brand {
    font-weight: 700;
    color: #333;
}

.subtitle {
    font-size: 14px;
    color: #777;
}

/* INPUT */
.form-control {
    border-radius: 10px;
    padding: 12px;
    border: 1px solid #ddd;
    font-size: 14px;
}

.form-control:focus {
    border-color: #4c84ff;
    box-shadow: 0 0 0 2px rgba(76,132,255,0.15);
}

/* LABEL */
label {
    font-size: 13px;
    color: #555;
}

/* BUTTON */
.btn-login {
    background: linear-gradient(135deg, #4c84ff, #6fa4ff);
    border: none;
    border-radius: 10px;
    padding: 12px;
    color: #fff;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 6px 15px rgba(76,132,255,0.25);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(76,132,255,0.35);
}

.btn-login:active {
    transform: scale(0.98);
}

/* ERROR */
.invalid-feedback {
    font-size: 12px;
}
</style>

<!-- BACKGROUND -->
<div class="bg-image"></div>
<div class="bg-overlay"></div>

<!-- CONTENT -->
<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="login-card">

        <div class="text-center mb-4">
            <h3 class="brand">SuaraKu</h3>
            <p class="subtitle">Layanan Aspirasi & Keluhan</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password" required>
            </div>

            <button class="btn btn-login w-100 mt-3">Login</button>
        </form>

    </div>
</div>

@endsection
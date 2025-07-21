<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect user based on role after login.
     */
    public function redirectTo()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin' => '/admin',
            'siswa' => '/siswa',
            'ortu'  => '/orangtua',
            default => '/',
        };
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Cek jika email kosong
        if (empty($request->email) && !empty($request->password)) {
            return back()->withErrors('Please fill the email')->withInput();
        }

        // Cek jika password kosong
        if (!empty($request->email) && empty($request->password)) {
            return back()->withErrors('Please fill the password')->withInput();
        }

        // Cek jika email dan password kosong, atau kredensial salah
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors('Email or Password does not match, please check again')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
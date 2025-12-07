<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Cek jika email kosong
        if (empty($request->email) && !empty($request->password) && !empty($request->password_confirmation)) {
            return back()->withErrors('Please fill the email')->withInput();
        }

        // Cek jika password kosong
        if (!empty($request->email) && empty($request->password) && !empty($request->password_confirmation)) {
            return back()->withErrors('Please fill the password')->withInput();
        }

        // Cek jika confirm password kosong
        if (!empty($request->email) && !empty($request->password) && empty($request->password_confirmation)) {
            return back()->withErrors('Please confirm password')->withInput();
        }

        // Cek jika semua kosong
        if (empty($request->email) && empty($request->password) && empty($request->password_confirmation)) {
            return back()->withErrors('Please enter your email and password')->withInput();
        }

        // Cek jika email sudah terdaftar
        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors('Email has been registered, try logging in or use another email')->withInput();
        }

        // Cek jika password tidak match dengan confirm password
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors('Password does not match')->withInput();
        }

        // Validasi tambahan untuk format email dan panjang password
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create user
        $user = User::create([
            'name' => explode('@', $request->email)[0], // Ambil nama dari email
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login setelah register
        Auth::login($user);

        return redirect()->route('user.homepage');
    }
}
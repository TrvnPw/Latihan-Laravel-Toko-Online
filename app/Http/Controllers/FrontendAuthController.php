<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendAuthController extends Controller
{
    // ================= REGISTER =================
    public function register()
    {
        // Mengarah ke folder v_register
        return view('frontend.v_register.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Perhatikan: unique:user (karena nama tabel lu 'user' tanpa 's')
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => '2', // '2' adalah role untuk customer sesuai migration lu
            'status' => 1, // '1' agar akun langsung berstatus aktif
        ]);

        Auth::login($user);

        return redirect()->route('frontend.index')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // ================= LOGIN =================
    public function login()
    {
        // Mengarah ke folder v_login
        return view('frontend.v_login.index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek login sekaligus ngecek apakah statusnya '1' (Aktif)
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1 
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role. Kalau Admin (0) atau SuperAdmin (1), lempar ke backend
            if (Auth::user()->role == '0' || Auth::user()->role == '1') {
                return redirect()->route('backend.beranda');
            }

            // Kalau customer (2), lempar ke frontend
            return redirect()->route('frontend.index')->with('success', 'Berhasil Login!');
        }

        return back()->with('error', 'Email/Password salah, atau akun belum aktif!');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.index')->with('success', 'Anda telah berhasil logout.');
    }
}
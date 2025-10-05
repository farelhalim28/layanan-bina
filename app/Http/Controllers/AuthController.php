<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Memproses form login
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Validasi: wajib diisi
        if (empty($username) || empty($password)) {
            return back()->with('error', 'Username dan password wajib diisi.');
        }

        // Validasi: password minimal 3 karakter dan mengandung huruf kapital
        if (strlen($password) < 3 || !preg_match('/[A-Z]/', $password)) {
            return back()->with('error', 'Password minimal 3 karakter dan harus mengandung huruf kapital.');
        }

        // Login sederhana tanpa database
        if ($username === 'Admin' && $password === 'adm123') {
            return redirect('/auth/berhasil')->with('success', 'Login berhasil! Selamat datang, Admin.');
        } else {
            return back()->with('error', 'Username atau password salah.');
        }
    }

    // Menampilkan halaman berhasil login
    public function berhasil()
    {
        return view('auth.berhasil');
    }
}

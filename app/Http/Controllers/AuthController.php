<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Data statis admin untuk development
    private static $admins = [
        [
            'id' => 1,
            'nama' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
            'created_at' => '2024-01-01 00:00:00'
        ],
        [
            'id' => 2,
            'nama' => 'Super Admin',
            'email' => 'superadmin@desa.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
            'created_at' => '2024-02-01 00:00:00'
        ]
    ];

    /**
     * Tampilkan form login admin
     */
    public function showLoginForm()
    {
        if (session('user')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = collect(self::$admins)->firstWhere('email', $request->email);

        if (!$admin) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }

        if (!Hash::check($request->password, $admin['password'])) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        session(['user' => $admin]);
        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Tampilkan form registrasi admin
     */
    public function showRegisterForm()
    {
        if (session('user')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.register');
    }

    /**
     * Proses registrasi admin
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        session()->flash('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->route('admin.login');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }
}

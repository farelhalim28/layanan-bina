<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // TAMBAHKAN INI
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        // Ganti dari session('user') jadi Auth::check()
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('pages.auth.login');
    }
    
    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        // GANTI: Pakai Auth::login() bukan session manual
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Tampilkan form register
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('pages.auth.register');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'nullable|string', // TAMBAHKAN INI (optional)
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'User', // Default role
        ]);

        return redirect()->route('admin.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // GANTI: Pakai Auth::logout()
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }
}

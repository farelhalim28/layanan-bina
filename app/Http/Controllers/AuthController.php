<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        if (session('user')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
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

        // Simpan session user
        session(['user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]]);

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Tampilkan form register
     */
    public function showRegisterForm()
    {
        if (session('user')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.register');
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
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Registrasi berhasil! Silakan login.');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\User;
use App\Models\Media; // tambahkan ini!

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $stats = [
            'total_warga' => Warga::count(),
            'total_jenis_surat' => JenisSurat::count(),
            'total_user' => User::count(),
        ];

        $warga = Warga::latest()->take(5)->get();
        $jenis_surat = JenisSurat::latest()->take(5)->get();
        $users = User::latest()->take(5)->get();
        $media = Media::latest()->get();

        return view('pages.dashboard', compact('stats', 'warga', 'jenis_surat', 'users', 'media'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\User;
use App\Models\Media;
use Carbon\Carbon; // wajib untuk ambil tanggal hari ini

class DashboardController extends Controller
{
    public function index()
    {
        // Cek login via session
        if (!session('user')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Statistik
        $stats = [
            'total_warga' => Warga::count(),
            'total_jenis_surat' => JenisSurat::count(),
            'total_user' => User::count(),
        ];

        // 🔥 WARGA HARI INI SAJA
        $warga = Warga::whereDate('created_at', Carbon::today())
                      ->latest()
                      ->take(5)
                      ->get();

        // Surat terbaru
        $jenis_surat = JenisSurat::latest()->take(5)->get();

        // User terbaru
        $users = User::latest()->take(5)->get();

        // Media terbaru
        $media = Media::latest()->get();

        return view('pages.dashboard', compact('stats', 'warga', 'jenis_surat', 'users', 'media'));
    }
}

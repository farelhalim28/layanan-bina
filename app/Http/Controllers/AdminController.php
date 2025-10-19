<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\JenisSurat;

class AdminController extends Controller
{
    /**
     * Dashboard - Tampil statistik Warga & Jenis Surat
     */
    public function dashboard()
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $stats = [
            'total_warga' => Warga::count(),
            'total_jenis_surat' => JenisSurat::count(),
        ];

        $warga = Warga::latest()->take(5)->get();
        $jenis_surat = JenisSurat::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'warga', 'jenis_surat'));
    }
}

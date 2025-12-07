<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\User;
use App\Models\Media;
use App\Models\PermohonanSurat;
use App\Models\BerkasPersyaratan;
use App\Models\RiwayatStatusSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // <--- FIX ERROR DISINI

class DashboardController extends Controller
{
    public function index()
    {
        // Cek Login (opsional karena sudah ada middleware)
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->withErrors('Silahkan login terlebih dahulu!');
        }

        // Statistik Utama
        $stats = [
            'total_warga' => Warga::count(),
            'total_jenis_surat' => JenisSurat::count(),
            'total_users' => User::count(),
            'total_media' => Media::count(),
            'total_permohonan' => PermohonanSurat::count(),
            'total_berkas' => BerkasPersyaratan::count(),

            // Status Permohonan
            'surat_pending' => PermohonanSurat::where('status', 'pending')->count(),
            'surat_diproses' => PermohonanSurat::where('status', 'diproses')->count(),
            'surat_selesai' => PermohonanSurat::where('status', 'selesai')->count(),
            'surat_ditolak' => PermohonanSurat::where('status', 'ditolak')->count(),

            'pending_request' => PermohonanSurat::where('status', 'pending')->count(),
        ];

        // Data Warga Terbaru
        $warga = Warga::latest()->take(5)->get();

        // Data Jenis Surat
        $jenis_surat = JenisSurat::latest()->take(5)->get();

        // Permohonan Surat Terbaru
        $permohonan_terbaru = PermohonanSurat::with(['pemohon', 'jenisSurat'])
            ->latest()
            ->take(5)
            ->get();

        // Media Terbaru
        $media_terbaru = Media::latest()->take(6)->get();

        // Grafik
        $chartData = $this->getMonthlyActivity();

        // Distribution untuk Donut Chart
        $statusDistribution = [
            'pending' => $stats['surat_pending'],
            'diproses' => $stats['surat_diproses'],
            'selesai' => $stats['surat_selesai'],
            'ditolak' => $stats['surat_ditolak'],
        ];

        return view('pages.dashboard', compact(
            'stats',
            'warga',
            'jenis_surat',
            'permohonan_terbaru',
            'media_terbaru',
            'chartData',
            'statusDistribution'
        ));
    }

    /**
     * Grafik Permohonan Per Bulan
     */
    private function getMonthlyActivity()
    {
        $currentYear = date('Y');

        $monthlyData = PermohonanSurat::selectRaw('MONTH(tanggal_pengajuan) as month, COUNT(*) as total')
            ->whereYear('tanggal_pengajuan', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Isi bulan kosong dengan 0
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyData[$i] ?? 0;
        }

        return $data;
    }
}

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

class DashboardController extends Controller
{
    public function index()
    {
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

        // Data Warga Terbaru (5 terbaru)
        $warga = Warga::latest()->take(5)->get();

        // Data Jenis Surat
        $jenis_surat = JenisSurat::latest()->take(5)->get();

        // Permohonan Surat Terbaru (5 terbaru)
        $permohonan_terbaru = PermohonanSurat::with(['pemohon', 'jenisSurat'])
            ->latest()
            ->take(5)
            ->get();

        // Media Terbaru (5 terbaru)
        $media_terbaru = Media::latest()->take(6)->get();

        // Data untuk Chart - Aktivitas Permohonan per Bulan (2025)
        $chartData = $this->getMonthlyActivity();

        // Status Distribution (untuk Donut Chart)
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
     * Get monthly activity data for chart
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

        // Fill missing months with 0
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyData[$i] ?? 0;
        }

        return $data;
    }
}

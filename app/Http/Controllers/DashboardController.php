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
use Illuminate\Support\Facades\Auth;

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
            'surat_pending' => PermohonanSurat::where('status', 'diajukan')->count(),
            'surat_diproses' => PermohonanSurat::where('status', 'diproses')->count(),
            'surat_selesai' => PermohonanSurat::where('status', 'selesai')->count(),
            'surat_ditolak' => PermohonanSurat::where('status', 'ditolak')->count(),
        ];

        // Data Warga Terbaru
        $warga = Warga::latest()->take(5)->get();

        // Permohonan Surat Terbaru
        $permohonan_terbaru = PermohonanSurat::with(['pemohon', 'jenisSurat'])
            ->latest()
            ->take(10)
            ->get();

        // Media Terbaru
        $media_terbaru = Media::latest()->take(6)->get();

        // Top Jenis Surat (diambil dari permohonan)
        $topJenisSurat = DB::table('jenis_surat')
            ->leftJoin('permohonan_surat', 'jenis_surat.jenis_id', '=', 'permohonan_surat.jenis_id')
            ->select(
                'jenis_surat.nama_jenis',
                DB::raw('COUNT(permohonan_surat.permohonan_id) as total_permohonan'),
                DB::raw("SUM(CASE WHEN permohonan_surat.status = 'selesai' THEN 1 ELSE 0 END) as selesai")
            )
            ->groupBy('jenis_surat.jenis_id', 'jenis_surat.nama_jenis')
            ->orderBy('total_permohonan', 'DESC')
            ->limit(5)
            ->get();

        // Grafik Data
        $chartData = $this->getMonthlyActivity();
        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        return view('pages.dashboard', compact(
            'stats',
            'warga',
            'permohonan_terbaru',
            'media_terbaru',
            'topJenisSurat',
            'chartData',
            'chartLabels'
        ));
    }

    /**
     * Grafik Permohonan Per Bulan
     */
    private function getMonthlyActivity()
    {
        $currentYear = date('Y');

        // Query permohonan berdasarkan bulan
        $monthlyData = PermohonanSurat::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
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

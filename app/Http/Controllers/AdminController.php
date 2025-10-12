<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Data statis sesuai struktur modul Bina Desa

    // Tabel: jenis_surat
    private static $jenisSurat = [
        [
            'jenis_id' => 1,
            'kode' => 'SKD',
            'no_ktp' => '1471010101990001',
            'nama' => 'Surat Keterangan Domisili',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'pekerjaan' => 'Pegawai Swasta',
            'telp' => '081234567890',
            'email' => 'budi@example.com',
            'nama_jenis' => 'Surat Keterangan Domisili',
            'template_file' => 'jenis_surat'
        ],
        [
            'jenis_id' => 2,
            'kode' => 'SKTM',
            'no_ktp' => '1471010202950002',
            'nama' => 'Surat Keterangan Tidak Mampu',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'telp' => '082345678901',
            'email' => 'siti@example.com',
            'nama_jenis' => 'Surat Keterangan Tidak Mampu',
            'template_file' => 'jenis_surat'
        ]
    ];

    // Tabel: permohonan_surat
    private static $permohonanSurat = [
        [
            'permohonan_id' => 1,
            'nomor_permohonan' => 'PRM/001/2024',
            'pemohon_user_id' => 1,
            'jenis_id' => 1,
            'images1_permohonan' => 'ktp_001.jpg',
            'status' => 'pending',
            'catatan' => null
        ],
        [
            'permohonan_id' => 2,
            'nomor_permohonan' => 'PRM/002/2024',
            'pemohon_user_id' => 2,
            'jenis_id' => 2,
            'images1_permohonan' => 'ktp_002.jpg',
            'status' => 'disetujui',
            'catatan' => 'Permohonan disetujui'
        ]
    ];

    // Tabel: berkas_persyaratan
    private static $berkasPersyaratan = [
        [
            'berkas_id' => 1,
            'permohonan_id' => 1,
            'nama_berkas' => 'KTP',
            'valid' => true
        ],
        [
            'berkas_id' => 2,
            'permohonan_id' => 1,
            'nama_berkas' => 'KK',
            'valid' => true
        ],
        [
            'berkas_id' => 3,
            'permohonan_id' => 2,
            'nama_berkas' => 'KTP',
            'valid' => true
        ]
    ];

    // Tabel: riwayat_status_surat
    private static $riwayatStatusSurat = [
        [
            'riwayat_id' => 1,
            'permohonan_id' => 1,
            'status' => 'pending',
            'petugas_warga_id' => null,
            'waktu' => '2024-10-01 10:00:00',
            'keterangan' => 'Permohonan diterima'
        ],
        [
            'riwayat_id' => 2,
            'permohonan_id' => 2,
            'status' => 'proses',
            'petugas_warga_id' => 1,
            'waktu' => '2024-10-02 09:00:00',
            'keterangan' => 'Sedang diproses'
        ],
        [
            'riwayat_id' => 3,
            'permohonan_id' => 2,
            'status' => 'disetujui',
            'petugas_warga_id' => 1,
            'waktu' => '2024-10-03 14:30:00',
            'keterangan' => 'Permohonan disetujui'
        ]
    ];

    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $stats = [
            'total_permohonan' => count(self::$permohonanSurat),
            'pending' => collect(self::$permohonanSurat)->where('status', 'pending')->count(),
            'proses' => collect(self::$permohonanSurat)->where('status', 'proses')->count(),
            'disetujui' => collect(self::$permohonanSurat)->where('status', 'disetujui')->count(),
            'ditolak' => collect(self::$permohonanSurat)->where('status', 'ditolak')->count(),
            'total_jenis_surat' => count(self::$jenisSurat)
        ];

        return view('admin.dashboard', [
            'user' => session('user'),
            'stats' => $stats,
            'permohonan' => self::$permohonanSurat,
            'jenis_surat' => self::$jenisSurat
        ]);
    }

    /**
     * CRUD Permohonan Surat
     */
    public function permohonanIndex()
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        return view('admin.permohonan.index', [
            'user' => session('user'),
            'permohonan' => self::$permohonanSurat
        ]);
    }

    public function permohonanShow($id)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $permohonan = collect(self::$permohonanSurat)->firstWhere('permohonan_id', (int)$id);

        if (!$permohonan) {
            return redirect()->route('admin.permohonan.index')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.permohonan.show', [
            'user' => session('user'),
            'permohonan' => $permohonan,
            'riwayat' => collect(self::$riwayatStatusSurat)->where('permohonan_id', (int)$id)->values()->all()
        ]);
    }

    public function permohonanUpdateStatus(Request $request, $id)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:pending,proses,disetujui,ditolak',
            'catatan' => 'nullable|string'
        ]);

        return redirect()->route('admin.permohonan.show', $id)->with('success', 'Status berhasil diupdate');
    }

    /**
     * CRUD Jenis Surat
     */
    public function jenisSuratIndex()
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        return view('admin.jenis_surat.index', [
            'user' => session('user'),
            'jenis_surat' => self::$jenisSurat
        ]);
    }

    public function jenisSuratCreate()
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        return view('admin.jenis_surat.create', [
            'user' => session('user')
        ]);
    }

    public function jenisSuratStore(Request $request)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'kode' => 'required|string',
            'nama_jenis' => 'required|string'
        ]);

        return redirect()->route('admin.jenis_surat.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function jenisSuratEdit($id)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $jenis = collect(self::$jenisSurat)->firstWhere('jenis_id', (int)$id);

        if (!$jenis) {
            return redirect()->route('admin.jenis_surat.index')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.jenis_surat.edit', [
            'user' => session('user'),
            'jenis' => $jenis
        ]);
    }

    public function jenisSuratUpdate(Request $request, $id)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'kode' => 'required|string',
            'nama_jenis' => 'required|string'
        ]);

        return redirect()->route('admin.jenis_surat.index')->with('success', 'Data berhasil diupdate');
    }

    public function jenisSuratDestroy($id)
    {
        if (!session('user')) {
            return redirect()->route('admin.login');
        }

        return redirect()->route('admin.jenis_surat.index')->with('success', 'Data berhasil dihapus');
    }
}

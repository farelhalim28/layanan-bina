<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermohonanSurat;

class PermohonanSuratSeeder extends Seeder
{
    public function run(): void
    {
        PermohonanSurat::create([
            'permohonan_id' => 1,
            'nomor_permohonan' => 'PM-001',
            'pemohon_warga_id' => 1,
            'jenis_id' => 1,
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
            'catatan' => 'Menunggu verifikasi',
        ]);
    }
}

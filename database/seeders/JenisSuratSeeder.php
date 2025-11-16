<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisSurat::create([
            'jenis_id' => 1,
            'kode' => 'SKTM',
            'nama_jenis' => 'Surat Keterangan Tidak Mampu',
            'syarat_json' => json_encode([
                'KTP',
                'KK',
                'Surat Pengantar RT'
            ]),
        ]);

    }
}

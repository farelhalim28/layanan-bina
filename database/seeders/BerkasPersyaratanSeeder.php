<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BerkasPersyaratan;

class BerkasPersyaratanSeeder extends Seeder
{
    public function run(): void
    {
        BerkasPersyaratan::create([
            'berkas_id' => 1,
            'permohonan_id' => 1,
            'nama_berkas' => 'KTP.jpg',
            'valid' => true,
        ]);
    }
}

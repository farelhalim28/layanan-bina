<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warga;
class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warga::create([
           'warga_id' => 1,
            'no_ktp' => '1234567890123456',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Karyawan Swasta',
            'telp' => '08123456789',
            'email' => 'budi@example.com',
        ]);
    }
}

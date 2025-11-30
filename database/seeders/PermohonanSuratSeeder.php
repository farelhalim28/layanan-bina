<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use Faker\Factory as Faker;

class PermohonanSuratSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua warga dan jenis surat yang ada
        $wargaIds = Warga::pluck('warga_id')->toArray();
        $jenisSuratIds = JenisSurat::pluck('jenis_id')->toArray();

        $statusList = ['pending', 'diproses', 'selesai', 'ditolak'];

        // Generate 100 permohonan surat
        for ($i = 1; $i <= 100; $i++) {
            PermohonanSurat::create([
                'nomor_permohonan' => 'PM-' . date('Y') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'pemohon_warga_id' => $faker->randomElement($wargaIds),
                'jenis_id' => $faker->randomElement($jenisSuratIds),
                'tanggal_pengajuan' => $faker->dateTimeBetween('-6 months', 'now'),
                'status' => $faker->randomElement($statusList),
                'catatan' => $faker->optional(0.5)->sentence(10),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 Permohonan Surat berhasil di-seed!');
    }
}

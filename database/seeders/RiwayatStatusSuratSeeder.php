<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatStatusSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use Faker\Factory as Faker;

class RiwayatStatusSuratSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID permohonan & warga
        $permohonanIds = PermohonanSurat::pluck('permohonan_id')->toArray();
        $petugasIds = Warga::pluck('warga_id')->toArray();

        $statusList = ['pending', 'diproses', 'selesai', 'ditolak'];

        // Generate 150 data
        for ($i = 1; $i <= 100; $i++) {
            RiwayatStatusSurat::create([
                'permohonan_id' => $faker->randomElement($permohonanIds),
                'status' => $faker->randomElement($statusList),
                'petugas_warga_id' => $faker->randomElement($petugasIds),
                'waktu' => $faker->dateTimeBetween('-6 months', 'now'),
                'keterangan' => $faker->optional()->sentence(),
            ]);
        }

        $this->command->info('100 Riwayat Status Surat berhasil di-seed!');
    }
}

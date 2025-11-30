<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use Faker\Factory as Faker;

class BerkasPersyaratanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua permohonan surat yang ada
        $permohonanIds = PermohonanSurat::pluck('permohonan_id')->toArray();

        $jenisBerkas = [
            'KTP.pdf', 'KK.pdf', 'Surat Pengantar RT.pdf', 'Surat Pengantar RW.pdf',
            'Pas Foto 3x4.jpg', 'Pas Foto 4x6.jpg', 'Akta Kelahiran.pdf',
            'Akta Nikah.pdf', 'NPWP.pdf', 'Kartu BPJS.pdf', 'Surat Keterangan Kerja.pdf',
            'Slip Gaji.pdf', 'Foto Tempat Usaha.jpg', 'Surat Izin Usaha.pdf',
            'Sertifikat Tanah.pdf', 'IMB.pdf', 'Dokumen Pendukung.pdf'
        ];

        // Generate 100 berkas persyaratan
        for ($i = 1; $i <= 100; $i++) {
            BerkasPersyaratan::create([
                'permohonan_id' => $faker->randomElement($permohonanIds),
                'nama_berkas' => $faker->randomElement($jenisBerkas),
                'valid' => $faker->boolean(70), // 70% valid
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 Berkas Persyaratan berhasil di-seed!');
    }
}

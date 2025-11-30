<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;
use Faker\Factory as Faker;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data awal yang pasti ada
        $jenisSuratAwal = [
            [
                'kode' => 'SKTM',
                'nama_jenis' => 'Surat Keterangan Tidak Mampu',
                'syarat_json' => json_encode(['KTP', 'KK', 'Surat Pengantar RT'])
            ],
            [
                'kode' => 'SKU',
                'nama_jenis' => 'Surat Keterangan Usaha',
                'syarat_json' => json_encode(['KTP', 'KK', 'Foto Tempat Usaha'])
            ],
            [
                'kode' => 'SKCK',
                'nama_jenis' => 'Surat Keterangan Catatan Kepolisian',
                'syarat_json' => json_encode(['KTP', 'KK', 'Pas Foto 4x6', 'Surat Pengantar RT/RW'])
            ],
            [
                'kode' => 'SKD',
                'nama_jenis' => 'Surat Keterangan Domisili',
                'syarat_json' => json_encode(['KTP', 'KK', 'Surat Pengantar RT'])
            ],
            [
                'kode' => 'SKPWNI',
                'nama_jenis' => 'Surat Keterangan Pindah WNI',
                'syarat_json' => json_encode(['KTP', 'KK', 'Surat Pengantar RT', 'Surat Keterangan Pindah'])
            ],
        ];

        foreach ($jenisSuratAwal as $jenis) {
            JenisSurat::create($jenis);
        }

        // Generate 95 data dummy lagi (total jadi 100)
        $jenisSuratList = [
            'Surat Keterangan Kelahiran',
            'Surat Keterangan Kematian',
            'Surat Keterangan Nikah',
            'Surat Keterangan Cerai',
            'Surat Keterangan Ahli Waris',
            'Surat Keterangan Tidak Bekerja',
            'Surat Keterangan Penghasilan',
            'Surat Keterangan Beda Nama',
            'Surat Keterangan Kehilangan',
            'Surat Pengantar Izin Keramaian',
            'Surat Pengantar Pembuatan KTP',
            'Surat Pengantar Pembuatan KK',
            'Surat Izin Kegiatan',
            'Surat Izin Usaha',
            'Surat Keterangan Jalan',
        ];

        $syaratList = [
            ['KTP', 'KK'],
            ['KTP', 'KK', 'Surat Pengantar RT'],
            ['KTP', 'KK', 'Pas Foto'],
            ['KTP', 'Surat Pengantar RT/RW'],
            ['KTP', 'KK', 'Akta Kelahiran'],
            ['KTP', 'KK', 'Dokumen Pendukung'],
        ];

        for ($i = 6; $i <= 100; $i++) {
            $namaJenis = $faker->randomElement($jenisSuratList);
            $kode = 'SK' . str_pad($i, 3, '0', STR_PAD_LEFT);

            JenisSurat::create([
                'kode' => $kode,
                'nama_jenis' => $namaJenis . ' ' . $i,
                'syarat_json' => json_encode($faker->randomElement($syaratList)),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 Jenis Surat berhasil di-seed!');
    }
}

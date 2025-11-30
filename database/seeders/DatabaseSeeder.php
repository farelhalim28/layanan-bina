<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan seeder sangat penting karena ada relasi foreign key
        $this->call([
            // 1. Seed User terlebih dahulu
            UserSeeder::class,

            // 2. Seed Warga (tidak ada relasi ke tabel lain)
            WargaSeeder::class,

            // 3. Seed JenisSurat (tidak ada relasi ke tabel lain)
            JenisSuratSeeder::class,

            // 4. Seed PermohonanSurat (butuh Warga & JenisSurat)
            PermohonanSuratSeeder::class,

            // 5. Seed BerkasPersyaratan (butuh PermohonanSurat)
            BerkasPersyaratanSeeder::class,

            // 5. Seed BerkasPersyaratan (butuh PermohonanSurat)
            RiwayatStatusSuratSeeder::class,
        ]);

        $this->command->info('🎉 Semua seeder berhasil dijalankan!');
    }
}

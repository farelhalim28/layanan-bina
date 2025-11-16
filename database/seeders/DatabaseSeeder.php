<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder User Admin Pertama
        User::factory()->create([
            'name' => 'Admin Pertama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Seeder Relasi Permohonan Surat dan Berkas Persyaratan
        $this->call([
            WargaSeeder::class,
            JenisSuratSeeder::class,
            PermohonanSuratSeeder::class,
            BerkasPersyaratanSeeder::class,
        ]);
    }
}

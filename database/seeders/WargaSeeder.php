<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaanList = [
            'PNS', 'TNI/Polri', 'Karyawan Swasta', 'Wiraswasta', 'Petani',
            'Nelayan', 'Guru', 'Dokter', 'Perawat', 'Pedagang',
            'Buruh', 'Sopir', 'Tukang', 'Pensiunan', 'Ibu Rumah Tangga'
        ];

        // Generate 100 data warga
        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = $faker->randomElement(['L', 'P']);
            $gender = $jenisKelamin == 'L' ? 'male' : 'female';

            Warga::create([
                'no_ktp' => $faker->unique()->numerify('3###############'), // KTP 16 digit
                'nama' => $faker->name($gender),
                'jenis_kelamin' => $jenisKelamin,
                'agama' => $faker->randomElement($agamaList),
                'pekerjaan' => $faker->randomElement($pekerjaanList),
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 Data Warga berhasil di-seed!');
    }
}

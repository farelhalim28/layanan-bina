<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // semua role tersedia random
        $roles = ['super admin', 'admin', 'user'];

        // fixed super admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'super admin',
            'email_verified_at' => now(),
        ]);

        // fixed admin
        User::create([
            'name' => 'Admin Default',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // generate 98 user random role
        for ($i = 1; $i <= 98; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => $faker->randomElement($roles),
                'email_verified_at' => $faker->optional()->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        $this->command->info('100 Users berhasil di-seed dengan role lengkap!');
    }
}

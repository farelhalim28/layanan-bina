<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // User admin pertama (tetap dari DatabaseSeeder)
        User::create([
            'name' => 'Admin Pertama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Generate 99 user lagi (total 100)
        for ($i = 1; $i <= 99; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => $faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
                'password' => Hash::make('password'), // password default: password
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 Users berhasil di-seed!');
    }
}

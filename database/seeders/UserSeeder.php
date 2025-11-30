<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User mentor default (ID = 1)
        User::create([
            'first_name' => 'Nadia',
            'last_name' => 'Mentor',
            'username' => 'nadia_mentor',
            'no_telepon' => '081234567890',
            'password' => 'password', // otomatis hashed karena $casts
            'role' => 'mentor',
            'status' => 'aktif',
            'deskripsi' => 'Mentor default untuk seeding.',
            'fotoProfil' => 'default.png',
        ]);

        // Tambahkan 5 user murid dummy
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'username' => fake()->unique()->userName(),
                'no_telepon' => fake()->phoneNumber(),
                'password' => 'password',
                'role' => 'murid',
                'status' => 'aktif',
                'deskripsi' => fake()->sentence(),
                'fotoProfil' => 'default.png',
            ]);
        }
    }
}

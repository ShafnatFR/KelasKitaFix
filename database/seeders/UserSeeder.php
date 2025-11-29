<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Nadia',
            'last_name' => 'Test',
            'username' => 'nadia',
            'no_telepon' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'mentor',
            'status' => 'aktif',
            'deskripsi' => 'Test user',
            'fotoProfil' => 'avatar.jpg',
        ]);

        User::factory(5)->create();
    }
}
<?php

namespace Database\Seeders;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama
        $user = User::first();

        // buat mentor
        Mentor::create([
            'user_id' => $user->id,   // otomatis id=1
            'status' => 'aktif'
        ]);
    }
}

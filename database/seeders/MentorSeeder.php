<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        Mentor::create([
            'user_id' => 1,
            'status' => 'aktif'
        ]);
    }
}

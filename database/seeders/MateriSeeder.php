<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Kelas;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            Materi::factory()->count(3)->create([
                'kelas_id' => $kelas->id
            ]);
        }
    }
}

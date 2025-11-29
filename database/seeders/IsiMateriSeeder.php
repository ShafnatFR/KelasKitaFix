<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IsiMateri;
use App\Models\Materi;

class IsiMateriSeeder extends Seeder
{
    public function run(): void
    {
        $materiList = Materi::all();

        foreach ($materiList as $materi) {
            IsiMateri::factory()->count(3)->create([
                'materi_id' => $materi->id
            ]);
        }
    }
}

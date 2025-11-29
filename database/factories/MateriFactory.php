<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class MateriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kelas_id' => Kelas::factory(), 
            'urutan' => $this->faker->numberBetween(1, 10),
            'judul_materi' => $this->faker->sentence(),
            'deskripsi_materi' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['draft', 'pending', 'diterima']),
        ];
    }
}

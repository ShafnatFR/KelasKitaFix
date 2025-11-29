<?php

namespace Database\Factories;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

class IsiMateriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_materi' => Materi::factory(),
            'judul' => $this->faker->sentence(),
            'konten' => $this->faker->paragraph(5),
            'tipe' => $this->faker->randomElement(['text','video','file']),
            'file_path' => $this->faker->url(),
        ];
    }
}

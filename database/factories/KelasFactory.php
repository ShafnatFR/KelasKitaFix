<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mentor_id' => 1, // default mentor ID, ganti sesuai data kamu
            'nama_kelas' => $this->faker->sentence(3),
            'kategori' => $this->faker->randomElement(['Programming', 'Design', 'Marketing']),
            'harga' => $this->faker->numberBetween(100000, 500000),
            'profil_kelas' => $this->faker->imageUrl(640, 480, 'education'),
            'deskripsi_kelas' => $this->faker->paragraph(),
            'status_publikasi' => 'draft',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->unique()->userName(),
            'no_telepon' => fake()->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['murid', 'mentor', 'admin']),
            'status' => 'aktif',
            'deskripsi' => fake()->text(100),
            'fotoProfil' => 'avatar.jpg',
        ];
    }
}

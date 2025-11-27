<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        $titles = ['Introduction to Web Development', 'Advanced React & Redux', 'Data Structures & Algorithms', 'Cloud Computing Fundamentals', 'UI/UX Design Principles', 'Python for Data Science'];
        
        return [
            'title' => $this->faker->unique()->randomElement($titles),
            'description' => $this->faker->sentence(10),
        ];
    }
}
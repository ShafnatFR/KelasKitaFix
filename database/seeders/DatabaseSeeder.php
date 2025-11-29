<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MentorSeeder::class,
            KelasSeeder::class,
            MateriSeeder::class,
            IsiMateriSeeder::class,
            CourseSeeder::class,
            UserCourseSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
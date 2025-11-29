<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            UserCourseSeeder::class,
            ReviewSeeder::class,
            KelasSeeder::class,
            MateriSeeder::class,
            IsiMateriSeeder::class,
        ]);

        
    }
}
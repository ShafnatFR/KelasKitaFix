<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Database\Seeder;

class UserCourseSeeder extends Seeder
{
    public function run()
    {
        
        $user = User::where('email', 'user@nadia.com')->first();
        
        
        if (!$user) {
            $user = User::first(); 
        }

     
        if (!$user) {
             echo "Error: Cannot find any user to assign courses to. Check your UserSeeder.\n";
             return; 
        }

        $courses = Course::all();
        $lessons = [
            'Pendahuluan: Memahami Konsep Dasar',
            'Instalasi Lingkungan Pengembangan',
            'Dasar-dasar Sintaks',
            'Struktur Kontrol dan Looping',
            'Membuat Fungsi dan Modul',
            'Proyek Akhir: Aplikasi Sederhana',
        ];

        foreach ($courses as $course) {
            $userCourse = UserCourse::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'progress_percentage' => 0,
                'enrolled_at' => now(),
            ]);

          
            foreach ($lessons as $index => $title) {
                $isCompleted = ($index < 3);
                $userCourse->progress()->create([
                    'lesson_number' => $index + 1,
                    'lesson_title' => $title,
                    'is_completed' => $isCompleted,
                ]);
            }

         
            $totalLessons = count($lessons);
            $completedLessons = $userCourse->progress->where('is_completed', true)->count();
            $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
            $userCourse->update(['progress_percentage' => $progressPercentage]);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        
        $userNadia = User::first(); 
        $userFactory1 = User::skip(1)->first(); 
        $userFactory2 = User::skip(2)->first(); 
        $userFactory3 = User::skip(3)->first(); 
        $userFactory4 = User::skip(4)->first(); 

       
        $course1 = Course::find(1); 
        $course2 = Course::find(2); 
        $course3 = Course::find(3); 
        $course4 = Course::find(4); 
        $course5 = Course::find(5); 
        $course6 = Course::find(6); 
        
 
        if (!$userNadia || !$course1 || !$course6 || !$userFactory4) {
            echo "Skipping ReviewSeeder: Not enough Users or Courses found. Did you run UserSeeder and CourseSeeder first?\n";
            return;
        }

       
        $reviewsData = [
          
            [
                'user_id' => $userNadia->id, 
                'course_id' => $course1->id, 
                'rating' => 5, 
                'comment' => 'Materi sangat jelas dan mudah dipahami! Sangat merekomendasikan kursus ini.',
            ],
          
            [
                'user_id' => $userFactory1->id, 
                'course_id' => $course1->id, 
                'rating' => 4, 
                'comment' => 'Konten bagus, tapi penjelasannya agak terlalu cepat di beberapa bagian.',
            ],
         
            [
                'user_id' => $userFactory2->id, 
                'course_id' => $course2->id, 
                'rating' => 5, 
                'comment' => 'Pengalaman yang luar biasa. Kursus Pemrograman Web ini mengubah cara saya coding!',
            ],
          
            [
                'user_id' => $userFactory3->id, 
                'course_id' => $course3->id, 
                'rating' => 3, 
                'comment' => 'Kursus UX lumayan, tapi butuh lebih banyak studi kasus praktikal.',
            ],
        
            [
                'user_id' => $userFactory4->id, 
                'course_id' => $course4->id, 
                'rating' => 4, 
                'comment' => 'UI Design yang solid! Saya suka fokus pada teori warna.',
            ],
        
            [
                'user_id' => $userNadia->id, 
                'course_id' => $course5->id, 
                'rating' => 5, 
                'comment' => 'Pengenalan Java sangat fundamental. Sempurna untuk pemula!',
            ],
           
            [
                'user_id' => $userFactory1->id, 
                'course_id' => $course6->id, 
                'rating' => 4, 
                'comment' => 'Algoritma dijelaskan dengan jelas, meskipun beberapa soal latihan terlalu sulit.',
            ],
        ];

        foreach ($reviewsData as $data) {
           
            Review::updateOrCreate(
                ['user_id' => $data['user_id'], 'course_id' => $data['course_id']],
                $data
            );
        }
    }
}
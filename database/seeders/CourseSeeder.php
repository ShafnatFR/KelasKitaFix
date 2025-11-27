<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $coursesData = [
            [
                'title' => 'Basis Data',
                'description' => 'Mempelajari konsep fundamental database, perancangan skema relasional, dan menguasai bahasa SQL untuk manajemen data yang efisien.',
            ],
            [
                'title' => 'Pemrograman Web',
                'description' => 'Mempelajari fundamental HTML, CSS, dan JavaScript untuk membangun struktur website yang responsif dan menarik dari nol hingga mahir.',
            ],
            [
                'title' => 'User Experience (UX)',
                'description' => 'Fokus pada proses perancangan pengalaman pengguna yang optimal, mulai dari riset pengguna, pembuatan persona, hingga wireframing dan prototyping.',
            ],
            [
                'title' => 'User Interface (UI) Design',
                'description' => 'Menguasai prinsip-prinsip desain visual, tipografi, dan *color theory* untuk menciptakan antarmuka yang indah, konsisten, dan mudah digunakan.',
            ],
            [
                'title' => 'Pengenalan Java',
                'description' => 'Pengenalan konsep dasar pemrograman berorientasi objek (OOP) menggunakan bahasa Java, termasuk variabel, tipe data, dan kontrol alur program.',
            ],
            [
                'title' => 'Algoritma dan Pemrograman',
                'description' => 'Memahami struktur data esensial dan algoritma dasar (seperti sorting, searching) untuk memecahkan masalah komputasi secara logis dan efisien.',
            ],
        ];

        foreach ($coursesData as $data) {
            // Cek apakah kursus dengan judul tersebut sudah ada, lalu buat atau update
            Course::updateOrCreate(
                ['title' => $data['title']],
                ['description' => $data['description']]
            );
        }
    }
}
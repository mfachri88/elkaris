<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExerciseList;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exerciseList = ExerciseList::create([
            'title' => 'Kuis Pengenalan Karir IT',
            'description' => 'Latihan soal untuk menguji pemahaman tentang berbagai karir di bidang IT.',
            'icon' => 'fa-briefcase', // Ikon bisa disesuaikan
            'color' => 'gray', // Warna bisa disesuaikan
            'is_active' => true,
        ]);
        $this->command->info('ExerciseList "Kuis Pengenalan Karir IT" berhasil dibuat.');

        // Membuat satu Exercise generik
        $exercise = Exercise::create([
            // 'material_id' => null, // Jika tidak dikaitkan dengan material spesifik di level exercise
            'title' => 'Kuis Campuran Karir IT',
            'description' => 'Soal-soal dari berbagai materi pengenalan karir di bidang IT.',
            'icon' => 'fa-question-circle', // Ikon bisa disesuaikan
            'color' => 'teal', // Warna bisa disesuaikan
            'total_question' => 5, // Sesuaikan dengan jumlah soal yang Anda buat di bawah
            'is_active' => true,
        ]);
        $this->command->info('Exercise "Kuis Campuran Karir IT" berhasil dibuat.');

        // Soal 1 (Dari Materi Software Developer)
        Question::create([
            'exercise_id' => $exercise->id,
            'question' => 'Profesi yang bertugas merancang, membuat, menguji, dan memelihara perangkat lunak atau aplikasi disebut...',
            'options' => json_encode([
                'A' => 'Data Scientist',
                'B' => 'Software Developer',
                'C' => 'Network Engineer',
                'D' => 'UI/UX Designer'
            ]),
            'correct_answer' => 'B',
            
        ]);

        // Soal 2 (Dari Materi Cybersecurity)
        Question::create([
            'exercise_id' => $exercise->id,
            'question' => 'Siapakah yang bertugas melindungi sistem dan data dari serangan siber?',
            'options' => json_encode([
                'A' => 'IT Consultant',
                'B' => 'Software Developer',
                'C' => 'Cybersecurity Analyst',
                'D' => 'Data Scientist'
            ]),
            'correct_answer' => 'C',
            
        ]);

        // Soal 3 (Dari Materi Data Scientist)
        Question::create([
            'exercise_id' => $exercise->id,
            'question' => 'Profesi yang ahli dalam mengumpulkan, menganalisis, dan menafsirkan data dalam jumlah besar untuk menemukan pola tersembunyi adalah...',
            'options' => json_encode([
                'A' => 'Network Engineer',
                'B' => 'UI/UX Designer',
                'C' => 'Software Developer',
                'D' => 'Data Scientist'
            ]),
            'correct_answer' => 'D',
           
        ]);

        // Soal 4 (Dari Materi Network Engineer)
        Question::create([
            'exercise_id' => $exercise->id,
            'question' => 'Siapakah yang bertanggung jawab merancang, membangun, dan memelihara infrastruktur jaringan komputer?',
            'options' => json_encode([
                'A' => 'Network Engineer',
                'B' => 'Software Developer',
                'C' => 'Data Scientist',
                'D' => 'IT Consultant'
            ]),
            'correct_answer' => 'A',
            
        ]);

        // Soal 5 (Dari Materi UI/UX Designer)
        Question::create([
            'exercise_id' => $exercise->id,
            'question' => 'Fokus utama seorang UX Designer adalah...',
            'options' => json_encode([
                'A' => 'Membuat tampilan visual yang paling menarik secara estetika.',
                'B' => 'Memastikan pengalaman pengguna secara keseluruhan mudah, efisien, dan memuaskan.',
                'C' => 'Menulis kode program untuk fungsionalitas aplikasi.',
                'D' => 'Mengamankan server dari serangan peretas.'
            ]),
            'correct_answer' => 'B',
        
        ]);
    }
}
<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Elkaris',
            'nis' => null, // Admin tidak memiliki NIS
            'email' => 'admin@elkaris.com',
            'password' => Hash::make('admin123'),
            'kelas' => null,
            'jurusan' => null,
            'jenis_kelamin' => null,
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Contoh Pengguna Siswa
        User::factory()->create([
            'name' => 'Budi Siswanto',
            'nis' => 12345678,
            'email' => 'budi.siswanto@example.com',
            'password' => Hash::make('siswa123'),
            'kelas' => 'XII',
            'jurusan' => 'IPA',
            'jenis_kelamin' => 'L',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Citra Ayu',
            'nis' => 87654321,
            'email' => 'citra.ayu@example.com',
            'password' => Hash::make('siswa123'),
            'kelas' => 'XI',
            'jurusan' => 'IPS',
            'jenis_kelamin' => 'P',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Materi Pengenalan Karir
        $materialsData = [
            [
                'title' => 'Mengenal Karir Software Developer',
                'description' => 'Apa itu Software Developer dan apa saja yang dikerjakannya?',
                'color' => 'blue', // Warna bisa disesuaikan
                'difficulty_level' => 'mudah',
                'is_active' => true,
            ],
            [
                'title' => 'Menjadi Ahli Keamanan Siber (Cybersecurity)',
                'description' => 'Peran penting seorang Cybersecurity Analyst di era digital.',
                'color' => 'red',
                'difficulty_level' => 'sedang',
                'is_active' => true,
            ],
            [
                'title' => 'Dunia Data Scientist: Mengungkap Cerita dari Data',
                'description' => 'Bagaimana Data Scientist mengubah data menjadi informasi berharga.',
                'color' => 'green',
                'difficulty_level' => 'sedang',
                'is_active' => true,
            ],
            [
                'title' => 'Network Engineer: Penjaga Konektivitas Dunia Maya',
                'description' => 'Mengenal tugas dan tanggung jawab seorang Network Engineer.',
                'color' => 'purple',
                'difficulty_level' => 'sedang',
                'is_active' => true,
            ],
            [
                'title' => 'Seni Merancang Pengalaman: Karir UI/UX Designer',
                'description' => 'Bagaimana UI/UX Designer membuat teknologi lebih ramah pengguna.',
                'color' => 'orange',
                'difficulty_level' => 'mudah',
                'is_active' => true,
            ],
            [
                'title' => 'IT Consultant: Penghubung Bisnis dan Teknologi',
                'description' => 'Peran strategis IT Consultant dalam membantu perusahaan berkembang.',
                'color' => 'yellow',
                'difficulty_level' => 'sedang',
                'is_active' => true,
            ],
        ];

        foreach ($materialsData as $material) {
            Material::create($material);
        }

        $this->call([
            MaterialContentSeeder::class,
            ExerciseSeeder::class,
            CareerTestQuestionSeeder::class,
        ]);
    }
}
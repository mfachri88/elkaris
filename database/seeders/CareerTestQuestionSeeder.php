<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerTestQuestion;

class CareerTestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if table already has questions, skip if not empty
        if (CareerTestQuestion::count() > 0) {
            return;
        }
        
        $questions = [
            // Preferensi untuk Software Developer
            [
                'text' => 'Saya senang mencari solusi untuk teka-teki atau masalah yang rumit.',
                'category' => 'software_developer'
            ],
            [
                'text' => 'Saya menikmati membangun sesuatu dari awal dan melihatnya berfungsi.',
                'category' => 'software_developer'
            ],
            [
                'text' => 'Saya merasa puas ketika berhasil memperbaiki sesuatu yang rusak atau tidak bekerja dengan baik.',
                'category' => 'software_developer'
            ],
            [
                'text' => 'Saya suka belajar hal-hal baru yang bersifat teknis secara mandiri.',
                'category' => 'software_developer'
            ],
            [
                'text' => 'Saya sering berpikir tentang bagaimana cara membuat suatu proses menjadi lebih efisien.',
                'category' => 'software_developer'
            ],
            
            // Preferensi untuk Data Scientist
            [
                'text' => 'Saya penasaran dengan angka dan suka mencari makna di baliknya.',
                'category' => 'data_scientist'
            ],
            [
                'text' => 'Saya suka mengumpulkan informasi dan menyusunnya agar mudah dipahami.',
                'category' => 'data_scientist'
            ],
            [
                'text' => 'Saya tertarik untuk memprediksi apa yang mungkin terjadi di masa depan berdasarkan data masa lalu.',
                'category' => 'data_scientist'
            ],
            [
                'text' => 'Saya menikmati menyajikan temuan atau cerita dari sekumpulan data.',
                'category' => 'data_scientist'
            ],
            [
                'text' => 'Saya suka menggunakan logika dan penalaran untuk mengambil kesimpulan.',
                'category' => 'data_scientist'
            ],
            
            // Preferensi untuk Network Engineer
            [
                'text' => 'Saya tertarik bagaimana perangkat elektronik bisa saling terhubung dan berkomunikasi.',
                'category' => 'network_engineer'
            ],
            [
                'text' => 'Saya suka mengatur dan memastikan semuanya berjalan lancar dalam sebuah sistem.',
                'category' => 'network_engineer'
            ],
            [
                'text' => 'Saya merasa tertantang untuk menjaga agar koneksi tetap stabil dan aman.',
                'category' => 'network_engineer'
            ],
            [
                'text' => 'Saya suka memecahkan masalah yang berkaitan dengan koneksi atau jaringan.',
                'category' => 'network_engineer'
            ],
            [
                'text' => 'Saya senang merencanakan dan membangun infrastruktur yang menghubungkan banyak hal.',
                'category' => 'network_engineer'
            ],
            
            // Preferensi untuk UI/UX Designer
            [
                'text' => 'Saya sering memperhatikan bagaimana tampilan sebuah aplikasi atau website bisa lebih mudah digunakan.',
                'category' => 'ui_ux_designer'
            ],
            [
                'text' => 'Saya peduli dengan kenyamanan orang lain saat menggunakan suatu produk digital.',
                'category' => 'ui_ux_designer'
            ],
            [
                'text' => 'Saya suka menggambar atau membuat sketsa ide-ide visual.',
                'category' => 'ui_ux_designer'
            ],
            [
                'text' => 'Saya menikmati proses merancang sesuatu yang terlihat menarik dan fungsional.',
                'category' => 'ui_ux_designer'
            ],
            [
                'text' => 'Saya sering berpikir dari sudut pandang pengguna saat menilai sebuah desain.',
                'category' => 'ui_ux_designer'
            ],
            
            // Preferensi untuk Cybersecurity Analyst
            [
                'text' => 'Saya sangat peduli dengan keamanan informasi pribadi saya dan orang lain.',
                'category' => 'cybersecurity_analyst'
            ],
            [
                'text' => 'Saya tertarik untuk memahami bagaimana cara melindungi sistem dari ancaman.',
                'category' => 'cybersecurity_analyst'
            ],
            [
                'text' => 'Saya suka menganalisis situasi untuk menemukan potensi risiko atau kelemahan.',
                'category' => 'cybersecurity_analyst'
            ],
            [
                'text' => 'Saya merasa bertanggung jawab untuk menjaga data tetap aman.',
                'category' => 'cybersecurity_analyst'
            ],
            [
                'text' => 'Saya suka mengikuti perkembangan berita tentang keamanan digital.',
                'category' => 'cybersecurity_analyst'
            ],
            
            // Preferensi untuk IT Consultant
            [
                'text' => 'Saya suka membantu orang lain memecahkan masalah mereka menggunakan teknologi.',
                'category' => 'it_consultant'
            ],
            [
                'text' => 'Saya menikmati menjelaskan hal-hal teknis dengan cara yang mudah dipahami orang awam.',
                'category' => 'it_consultant'
            ],
            [
                'text' => 'Saya suka merencanakan proyek dan memastikan semuanya berjalan sesuai rencana.',
                'category' => 'it_consultant'
            ],
            [
                'text' => 'Saya senang bekerja dengan berbagai macam orang dan memahami kebutuhan mereka.',
                'category' => 'it_consultant'
            ],
            [
                'text' => 'Saya mampu melihat gambaran besar dan memberikan saran strategis terkait teknologi.',
                'category' => 'it_consultant'
            ],
        ];

        foreach ($questions as $question) {
            CareerTestQuestion::create($question);
        }
    }
}

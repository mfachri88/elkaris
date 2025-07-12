<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerTest;
use App\Models\CareerTestQuestion;
use App\Models\CareerTestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class CareerTestController extends Controller
{
    // Daftar karir IT yang dianalisis
    private $careers = [
        'software_developer',
        'data_scientist',
        'network_engineer',
        'ui_ux_designer',
        'cybersecurity_analyst',
        'it_consultant'
    ];

    public function index()
    {
        // Ambil pertanyaan untuk tes minat bakat karir IT dari database
        $questions = CareerTestQuestion::all();
        
        return view('pages.career-test.index', compact('questions'));
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        
        if (empty($answers)) {
            return redirect()->back()->with('error', 'Anda belum menjawab pertanyaan apapun');
        }
        
        try {
            // Proses jawaban dengan metode perhitungan manual
            $calculatedResult = $this->processAnswersManual($answers);
            
            // Pastikan result field memiliki nilai
            if (!isset($calculatedResult['result']) || !$calculatedResult['result']) {
                $calculatedResult['result'] = $this->determineDefaultResult($calculatedResult);
            }
            
            // Simpan hasil ke database
            $testResult = CareerTestResult::create([
                'user_id' => Auth::id(),
                'software_developer' => $calculatedResult['software_developer'] ?? 0,
                'data_scientist' => $calculatedResult['data_scientist'] ?? 0,
                'network_engineer' => $calculatedResult['network_engineer'] ?? 0,
                'ui_ux_designer' => $calculatedResult['ui_ux_designer'] ?? 0,
                'cybersecurity_analyst' => $calculatedResult['cybersecurity_analyst'] ?? 0,
                'it_consultant' => $calculatedResult['it_consultant'] ?? 0,
                'result' => $calculatedResult['result']
            ]);
            
            // Simpan metadata dengan informasi dasar
            if (Schema::hasColumn('career_test_results', 'metadata')) {
                $testResult->metadata = json_encode([
                    'strengths' => $this->generateStrengths($calculatedResult),
                    'improvement_areas' => $this->generateImprovementAreas($calculatedResult),
                    'manual_calculated' => true
                ]);
                $testResult->save();
            }
            
            return redirect()->route('tes-minat-bakat.result', $testResult->id);
        } catch (\Exception $e) {
            Log::error('Error in career test analysis: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam analisis. Silakan coba lagi.');
        }
    }

    public function result($id)
    {
        $testResult = CareerTestResult::findOrFail($id);
        
        // Pastikan hanya user yang bersangkutan yang bisa lihat hasil
        if ($testResult->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }
        
        // Data deskripsi karir
        $careerDescriptions = $this->getCareerDescriptions();
        
        // Ambil metadata jika ada
        $metadata = null;
        if (Schema::hasColumn('career_test_results', 'metadata') && $testResult->metadata) {
            $metadata = json_decode($testResult->metadata, true);
        }
        
        // Persiapkan data untuk tampilan
        $results = [
            'software_developer' => $testResult->software_developer,
            'data_scientist' => $testResult->data_scientist,
            'network_engineer' => $testResult->network_engineer,
            'ui_ux_designer' => $testResult->ui_ux_designer,
            'cybersecurity_analyst' => $testResult->cybersecurity_analyst,
            'it_consultant' => $testResult->it_consultant
        ];
        
        $highestCategory = $testResult->result;
        
        // Mempersiapkan data kategori untuk view
        $categories = [];
        foreach ($this->careers as $career) {
            $categories[$career] = [
                'name' => $careerDescriptions[$career]['title'],
                'description' => $careerDescriptions[$career]['description'],
                'color' => $this->getColorForCareer($career),
                'icon' => $this->getIconForCareer($career)
            ];
        }
        
        // --- PERBAIKAN DIMULAI DI SINI ---
        // Selalu coba dapatkan rekomendasi studi berdasarkan kategori tertinggi
        $recommendedStudies = $this->getRecommendedStudies($highestCategory);

        $recommendations = []; // Inisialisasi

        // Logika untuk $recommendations['careers']
        // Jika metadata['strengths'] tidak ada atau kosong, maka isi $recommendations['careers']
        // Jika ada, biarkan Blade yang menanganinya (karena Blade akan menggunakan $careerDescriptions[$highestCategory]['career_paths'] jika metadata['strengths'] ada)
        if (!isset($metadata['strengths']) || count($metadata['strengths']) === 0) {
            $recommendations['careers'] = $careerDescriptions[$highestCategory]['career_paths'] ?? [];
        }
        // Jika metadata['strengths'] ada, $recommendations['careers'] tidak perlu diisi di sini
        // karena Blade akan menggunakan $careerDescriptions[$highestCategory]['career_paths'] secara langsung.

        // Selalu isi rekomendasi studi
        $recommendations['studies'] = $recommendedStudies;
        // --- PERBAIKAN SELESAI DI SINI ---
        
        return view('pages.career-test.result', compact(
            'testResult', 
            'careerDescriptions', 
            'metadata', 
            'results', 
            'highestCategory', 
            'categories',
            'recommendations' // $recommendations sekarang selalu memiliki 'studies'
        ));
    }

    public function history()
    {
        // Ambil semua hasil tes milik user yang sedang login
        $testResults = CareerTestResult::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Data deskripsi karir
        $careerDescriptions = $this->getCareerDescriptions();
        
        return view('pages.career-test.history', compact('testResults', 'careerDescriptions'));
    }

    /**
     * Memproses jawaban tes dengan metode perhitungan manual
     */
    private function processAnswersManual($answers)
    {
        $categories = [
            'software_developer' => 0,
            'data_scientist' => 0,
            'network_engineer' => 0,
            'ui_ux_designer' => 0,
            'cybersecurity_analyst' => 0,
            'it_consultant' => 0
        ];
        
        // Get all questions from database
        $questions = CareerTestQuestion::all();
        
        foreach ($answers as $questionId => $score) {
            $question = $questions->firstWhere('id', (int)$questionId);
            if ($question) {
                $categories[$question->category] += (int)$score;
            }
        }
        
        // Hitung skor maksimum per kategori
        $questionsPerCategory = [];
        foreach ($questions as $question) {
            if (!isset($questionsPerCategory[$question->category])) {
                $questionsPerCategory[$question->category] = 0;
            }
            $questionsPerCategory[$question->category]++;
        }
        
        // Konversi ke persentase
        foreach ($categories as $category => $score) {
            $maxScore = isset($questionsPerCategory[$category]) ? $questionsPerCategory[$category] * 5 : 0; // 5 adalah skor maksimum per pertanyaan
            $categories[$category] = $maxScore > 0 ? round(($score / $maxScore) * 100) : 0;
        }
        
        // Tentukan hasil utama (kategori dengan skor tertinggi)
        $maxValue = max($categories);
        $maxCategory = array_keys($categories, $maxValue)[0];
        
        // Format hasil untuk database
        $result = $categories;
        $result['result'] = $maxCategory;
        
        return $result;
    }

    /**
     * Menentukan kategori default jika tidak ada yang dominan
     */
    private function determineDefaultResult($scores)
    {
        // Hapus kunci 'result' jika ada
        if (isset($scores['result'])) {
            unset($scores['result']);
        }
        
        // Jika array kosong, kembalikan default
        if (empty($scores)) {
            return 'software_developer';
        }
        
        // Cari kategori dengan skor tertinggi
        $maxScore = max($scores);
        $maxCategories = array_keys($scores, $maxScore);
        
        // Jika ada beberapa kategori dengan skor yang sama, pilih yang pertama
        return $maxCategories[0] ?? 'software_developer';
    }
    
    /**
     * Menghasilkan kekuatan berdasarkan hasil
     */
    private function generateStrengths($result)
    {
        $strengths = [];
        $careerDescriptions = $this->getCareerDescriptions();
        
        // Temukan 2 karir dengan skor tertinggi
        $resultsCopy = $result;
        unset($resultsCopy['result']);
        arsort($resultsCopy);
        
        $topCareers = array_slice(array_keys($resultsCopy), 0, 2);
        
        foreach ($topCareers as $career) {
            $careerSkills = $careerDescriptions[$career]['skills'] ?? [];
            $strengths = array_merge($strengths, array_slice($careerSkills, 0, 2));
        }
        
        return array_unique($strengths);
    }
    
    /**
     * Menghasilkan area pengembangan berdasarkan hasil
     */
    private function generateImprovementAreas($result)
    {
        $improvementAreas = [];
        $careerDescriptions = $this->getCareerDescriptions();
        
        // Temukan karir dengan skor tertinggi
        $primaryCareer = $result['result'];
        
        // Ambil 3 skill acak dari karir utama sebagai area pengembangan
        $careerSkills = $careerDescriptions[$primaryCareer]['skills'] ?? [];
        if (count($careerSkills) > 3) {
            $improvementAreas = array_slice($careerSkills, -3);
        } else {
            $improvementAreas = $careerSkills;
        }
        
        return $improvementAreas;
    }
    
    /**
     * Mendapatkan warna untuk setiap karir
     */
    private function getColorForCareer($career)
    {
        $colors = [
            'software_developer' => 'blue',
            'data_scientist' => 'purple',
            'network_engineer' => 'green',
            'ui_ux_designer' => 'pink',
            'cybersecurity_analyst' => 'red',
            'it_consultant' => 'cyan'
        ];
        
        return $colors[$career] ?? 'gray';
    }
    
    /**
     * Mendapatkan ikon untuk setiap karir
     */
    private function getIconForCareer($career)
    {
        $icons = [
            'software_developer' => 'fa-code',
            'data_scientist' => 'fa-chart-bar',
            'network_engineer' => 'fa-network-wired',
            'ui_ux_designer' => 'fa-paint-brush',
            'cybersecurity_analyst' => 'fa-shield-alt',
            'it_consultant' => 'fa-comments'
        ];
        
        return $icons[$career] ?? 'fa-question';
    }
    
    /**
     * Mendapatkan rekomendasi studi berdasarkan karir
     */
    private function getRecommendedStudies($career)
    {
        $studyRecommendations = [
            'software_developer' => [
                'Teknik Informatika',
                'Ilmu Komputer',
                'Rekayasa Perangkat Lunak',
                'Pengembangan Web/Mobile',
                'Pengembangan Game' // Ditambahkan dari solusi sebelumnya
            ],
            'data_scientist' => [
                'Ilmu Data',
                'Statistika',
                'Matematika Komputasi',
                'Machine Learning',
                'Artificial Intelligence',
                'Teknik Industri' // Ditambahkan dari solusi sebelumnya
            ],
            'network_engineer' => [
                'Sistem Jaringan Komputer',
                'Telekomunikasi',
                'Keamanan Jaringan',
                'Cloud Computing',
                'Teknik Elektro' // Ditambahkan dari solusi sebelumnya
            ],
            'ui_ux_designer' => [
                'Desain Interaksi',
                'Psikologi Kognitif',
                'Desain Grafis',
                'Pengalaman Pengguna',
                'Desain Komunikasi Visual (DKV)', // Ditambahkan dari solusi sebelumnya
                'Desain Produk' // Ditambahkan dari solusi sebelumnya
            ],
            'cybersecurity_analyst' => [
                'Keamanan Informasi',
                'Kriptografi',
                'Forensik Digital',
                'Ethical Hacking',
                'Teknik Komputer' // Ditambahkan dari solusi sebelumnya
            ],
            'it_consultant' => [
                'Sistem Informasi',
                'Manajemen TI',
                'Bisnis TI',
                'Analisis Bisnis',
                'Teknik Industri', // Ditambahkan dari solusi sebelumnya
                'Bisnis Digital' // Ditambahkan dari solusi sebelumnya
            ]
        ];
        
        return $studyRecommendations[$career] ?? [];
    }

    /**
     * Deskripsi karir untuk hasil tes
     */
    private function getCareerDescriptions()
    {
        return [
            'software_developer' => [
                'title' => 'Software Developer',
                'description' => 'Berdasarkan hasil tes, Anda memiliki minat yang tinggi dalam pengembangan perangkat lunak. Software Developer bertanggung jawab untuk merancang, mengembangkan, dan memelihara program komputer sesuai kebutuhan pengguna.',
                'skills' => [
                    'Pemrograman dalam berbagai bahasa seperti Java, Python, JavaScript, C++',
                    'Pemahaman algoritma dan struktur data',
                    'Version control (Git)',
                    'Pengujian dan debugging',
                    'Pemahaman metodologi pengembangan software (Agile, Scrum)',
                ],
                'career_paths' => [
                    'Front-end Developer',
                    'Back-end Developer',
                    'Full-stack Developer',
                    'Mobile App Developer',
                    'Game Developer',
                    'DevOps Engineer',
                ],
                'image' => 'software-developer.jpg',
            ],
            'data_scientist' => [
                'title' => 'Data Scientist',
                'description' => 'Hasil tes menunjukkan bahwa Anda memiliki kecenderungan kuat dalam analisis data. Data Scientist menggunakan keahlian dalam statistik, matematika, dan pemrograman untuk menganalisis data dan menghasilkan insights untuk pengambilan keputusan.',
                'skills' => [
                    'Statistik dan matematika',
                    'Pemrograman (Python, R)',
                    'Machine Learning',
                    'Data visualization',
                    'Big data processing',
                    'SQL dan database management',
                ],
                'career_paths' => [
                    'Data Analyst',
                    'Machine Learning Engineer',
                    'AI Specialist',
                    'Business Intelligence Analyst',
                    'Research Scientist',
                    'Quantitative Analyst',
                ],
                'image' => 'data-scientist.jpg',
            ],
            'network_engineer' => [
                'title' => 'Network Engineer',
                'description' => 'Berdasarkan hasil tes, Anda memiliki ketertarikan yang tinggi pada infrastruktur jaringan. Network Engineer bertanggung jawab untuk merancang, mengimplementasikan, dan mengelola sistem jaringan komputer untuk memastikan konektivitas yang aman dan handal.',
                'skills' => [
                    'Protokol jaringan TCP/IP',
                    'Routing dan switching',
                    'Network security',
                    'Cloud infrastructure',
                    'Troubleshooting',
                    'Virtualisasi',
                ],
                'career_paths' => [
                    'Network Administrator',
                    'Cloud Infrastructure Engineer',
                    'Systems Engineer',
                    'Network Security Specialist',
                    'Telecommunications Engineer',
                    'IoT Network Specialist',
                ],
                'image' => 'network-engineer.jpg',
            ],
            'ui_ux_designer' => [
                'title' => 'UI/UX Designer',
                'description' => 'Hasil tes menunjukkan bahwa Anda memiliki kecenderungan kuat dalam desain antarmuka dan pengalaman pengguna. UI/UX Designer merancang bagaimana pengguna berinteraksi dengan aplikasi, dengan mempertimbangkan aspek visual dan kegunaan.',
                'skills' => [
                    'Prinsip desain UI',
                    'User research',
                    'Wireframing dan prototyping',
                    'Usability testing',
                    'Design tools (Figma, Adobe XD, Sketch)',
                    'HTML/CSS (dasar)',
                ],
                'career_paths' => [
                    'User Interface (UI) Designer',
                    'User Experience (UX) Designer',
                    'Product Designer',
                    'Interaction Designer',
                    'UX Researcher',
                    'Information Architect',
                ],
                'image' => 'ui-ux-designer.jpg',
            ],
            'cybersecurity_analyst' => [
                'title' => 'Cybersecurity Analyst',
                'description' => 'Berdasarkan hasil tes, Anda memiliki ketertarikan yang tinggi pada keamanan informasi. Cybersecurity Analyst bertanggung jawab untuk melindungi sistem dan jaringan dari ancaman digital dengan memantau, mendeteksi, dan merespons insiden keamanan.',
                'skills' => [
                    'Network security',
                    'Pengetahuan tentang ancaman cyber',
                    'Penetration testing',
                    'Security tools dan teknologi',
                    'Coding dan scripting',
                    'Regulatory compliance',
                ],
                'career_paths' => [
                    'Security Engineer',
                    'Penetration Tester',
                    'Security Consultant',
                    'Security Architect',
                    'Forensic Analyst',
                    'Incident Responder',
                ],
                'image' => 'cybersecurity-analyst.jpg',
            ],
            'it_consultant' => [
                'title'       => 'IT Consultant',
                'description' => 'Sebagai IT Consultant, Anda membantu organisasi merancang dan mengimplementasikan solusi TI yang efektif.',
                'skills'      => [
                    'Analisis kebutuhan bisnis',
                    'Manajemen proyek TI',
                    'Komunikasi lintas tim',
                    'Solusi arsitektur TI',
                    'Strategic planning'
                ],
                'career_paths' => [
                    'IT Consultant',
                    'Business Analyst',
                    'Solution Architect',
                    'Technology Advisor'
                ],
                'image' => 'it-consultant.jpg',
            ],
        ];
    }
}
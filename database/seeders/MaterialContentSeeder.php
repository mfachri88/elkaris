<?php

namespace Database\Seeders;

use App\Models\MaterialContent;
use Illuminate\Database\Seeder;

class MaterialContentSeeder extends Seeder
{
    public function run()
    {
        MaterialContent::truncate();
        
        $contents = [
            //=========================================================
            // MATERI 1: SOFTWARE DEVELOPER
            //=========================================================
            
            // Pengenalan Software Developer
            [
                'material_id' => 1,
                'section_type' => 'pengenalan',
                'title' => 'Apa itu Software Developer?',
                'content' => '<div class="space-y-4">
                    <p>Pernahkah kamu menggunakan aplikasi di handphone atau komputer? Nah, orang di balik pembuatan aplikasi itu adalah <strong>Software Developer</strong>!</p>
                    <p>Mereka adalah para arsitek dan pembangun di dunia digital. Tugas utama mereka adalah merancang, membuat, menguji, dan memelihara berbagai jenis perangkat lunak atau aplikasi.</p>
                    <p>Bayangkan mereka seperti koki yang meracik berbagai bahan (kode program) untuk menciptakan hidangan lezat (aplikasi yang berguna dan menyenangkan).</p>
                    <p>Di era digital seperti sekarang, Software Developer menjadi salah satu profesi yang paling dicari dan memiliki peluang karir yang sangat luas.</p>
                </div>',
            ],
            
            // Materi Utama 1 - Software Developer
            [
                'material_id' => 1,
                'section_type' => 'materi_utama',
                'title' => 'Tugas Utama Software Developer',
                'content' => '<div class="space-y-4">
                    <p>Seorang Software Developer melakukan banyak hal, di antaranya:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Menulis Kode:</strong> Ini adalah inti pekerjaan mereka, seperti menulis resep untuk aplikasi. Mereka menggunakan bahasa pemrograman seperti Java, Python, JavaScript, dan lain-lain.</li>
                        <li><strong>Merancang Aplikasi:</strong> Memikirkan bagaimana aplikasi akan terlihat dan berfungsi, serta fitur apa saja yang diperlukan.</li>
                        <li><strong>Menguji Aplikasi:</strong> Memastikan aplikasi berjalan lancar tanpa masalah (bug) dan sesuai dengan kebutuhan pengguna.</li>
                        <li><strong>Memperbaiki Masalah:</strong> Jika ada error atau bug, mereka yang akan mencari dan memperbaikinya.</li>
                        <li><strong>Berkolaborasi dengan Tim:</strong> Biasanya bekerja bersama desainer, manajer produk, dan developer lain untuk menciptakan produk yang lengkap.</li>
                    </ul>
                </div>',
            ],
            
            // Materi Utama 2 - Software Developer
            [
                'material_id' => 1,
                'section_type' => 'materi_utama',
                'title' => 'Jenis-Jenis Software Developer',
                'content' => '<div class="space-y-4">
                    <p>Ada berbagai macam spesialisasi dalam dunia pengembangan software:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Frontend Developer:</strong> Fokus pada bagian yang bisa dilihat dan diinteraksikan oleh pengguna, seperti tampilan website atau aplikasi.</li>
                        <li><strong>Backend Developer:</strong> Bekerja di "balik layar", mengurus database, server, dan logika aplikasi yang tidak terlihat pengguna.</li>
                        <li><strong>Full Stack Developer:</strong> Menguasai kedua bidang frontend dan backend.</li>
                        <li><strong>Mobile Developer:</strong> Khusus membuat aplikasi untuk smartphone (Android/iOS).</li>
                        <li><strong>Game Developer:</strong> Membuat game untuk berbagai platform.</li>
                        <li><strong>DevOps Engineer:</strong> Menghubungkan pengembangan dengan operasional IT untuk pengiriman software yang lebih cepat dan andal.</li>
                    </ul>
                    <p>Setiap spesialisasi memiliki tantangan dan keahlian yang berbeda, sehingga kamu bisa memilih yang paling sesuai dengan minat dan bakatmu.</p>
                </div>',
            ],
            
            // Materi Utama 3 - Software Developer
            [
                'material_id' => 1,
                'section_type' => 'materi_utama',
                'title' => 'Bahasa Pemrograman Populer',
                'content' => '<div class="space-y-4">
                    <p>Software Developer menggunakan berbagai bahasa pemrograman sesuai kebutuhan proyek. Beberapa bahasa populer antara lain:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Python:</strong> Terkenal karena mudah dipelajari dan serbaguna, digunakan dalam pengembangan web, analisis data, kecerdasan buatan, dan otomasi.</li>
                        <li><strong>JavaScript:</strong> Bahasa utama untuk pengembangan web, digunakan untuk membuat website interaktif dan dinamis.</li>
                        <li><strong>Java:</strong> Digunakan untuk aplikasi enterprise, Android, dan sistem berskala besar.</li>
                        <li><strong>C#:</strong> Dikembangkan oleh Microsoft, populer untuk pengembangan aplikasi Windows dan game (Unity).</li>
                        <li><strong>PHP:</strong> Banyak digunakan untuk pengembangan website dan aplikasi web.</li>
                        <li><strong>Swift:</strong> Dikembangkan oleh Apple untuk membuat aplikasi iOS dan macOS.</li>
                        <li><strong>Kotlin:</strong> Modern dan menjadi pilihan utama untuk pengembangan Android.</li>
                    </ul>
                    <p>Sebagai pemula, tidak perlu khawatir harus menguasai semua bahasa. Lebih baik fokus mempelajari satu bahasa dengan baik terlebih dahulu, lalu berkembang sesuai kebutuhan.</p>
                </div>',
            ],
            
            // Materi Utama 4 - Software Developer
            [
                'material_id' => 1,
                'section_type' => 'materi_utama',
                'title' => 'Keterampilan yang Dibutuhkan',
                'content' => '<div class="space-y-4">
                    <p>Untuk menjadi Software Developer yang sukses, kamu perlu mengembangkan keterampilan berikut:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Algoritma dan Struktur Data:</strong> Dasar pemecahan masalah dalam pemrograman</li>
                        <li><strong>Pemahaman Database:</strong> SQL dan NoSQL untuk menyimpan dan mengelola data</li>
                        <li><strong>Version Control:</strong> Seperti Git untuk mengelola perubahan kode</li>
                        <li><strong>Testing:</strong> Metode dan alat untuk menguji kualitas software</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Non-Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Pemecahan Masalah:</strong> Kemampuan menganalisis dan menyelesaikan masalah kompleks</li>
                        <li><strong>Komunikasi:</strong> Menjelaskan konsep teknis kepada non-teknisi</li>
                        <li><strong>Kerja Tim:</strong> Berkolaborasi dalam proyek bersama</li>
                        <li><strong>Belajar Mandiri:</strong> Teknologi selalu berubah, jadi harus selalu update</li>
                    </ul>
                    <p>Ingat, kombinasi antara keterampilan teknis dan non-teknis akan membuatmu menjadi Software Developer yang sangat dihargai di industri.</p>
                </div>',
            ],
            
            // Materi Utama 5 - Software Developer
            [
                'material_id' => 1,
                'section_type' => 'materi_utama',
                'title' => 'Jalur Karir dan Prospek',
                'content' => '<div class="space-y-4">
                    <p>Karir sebagai Software Developer menawarkan jalur perkembangan yang menjanjikan:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Junior Developer → Mid-level Developer → Senior Developer:</strong> Jalur umum dengan tanggung jawab dan keahlian yang meningkat</li>
                        <li><strong>Technical Lead / Team Lead:</strong> Memimpin tim developer</li>
                        <li><strong>Software Architect:</strong> Merancang struktur keseluruhan sistem software</li>
                        <li><strong>CTO (Chief Technology Officer):</strong> Posisi eksekutif yang mengawasi semua aspek teknologi</li>
                        <li><strong>Technical Consultant / Freelancer:</strong> Bekerja secara independen untuk berbagai klien</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <p>Software Developer termasuk profesi dengan prospek sangat baik karena:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Permintaan Tinggi:</strong> Kebutuhan developer terus meningkat di seluruh dunia</li>
                        <li><strong>Gaji Kompetitif:</strong> Termasuk salah satu profesi dengan bayaran tertinggi</li>
                        <li><strong>Fleksibilitas:</strong> Bisa bekerja remote dari mana saja</li>
                        <li><strong>Inovasi:</strong> Selalu ada teknologi baru untuk dipelajari dan dikembangkan</li>
                    </ul>
                    <p>Karir di bidang ini juga sangat fleksibel dan memungkinkan perpindahan ke bidang terkait seperti data science, artificial intelligence, product management, atau UX/UI design sesuai minat.</p>
                </div>',
            ],
            
            //=========================================================
            // MATERI 2: CYBERSECURITY ANALYST
            //=========================================================
            
            // Pengenalan Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'pengenalan',
                'title' => 'Mengapa Keamanan Siber Itu Penting?',
                'content' => '<div class="space-y-4">
                    <p>Di dunia yang serba digital ini, banyak informasi penting kita tersimpan online, mulai dari data pribadi hingga rahasia perusahaan.</p>
                    <p>Seorang <strong>Ahli Keamanan Siber</strong> atau <strong>Cybersecurity Analyst</strong> bertugas melindungi semua informasi itu dari serangan peretas atau pihak yang tidak bertanggung jawab.</p>
                    <p>Mereka seperti penjaga benteng digital yang memastikan data kita aman dan tidak disalahgunakan.</p>
                    <p>Dengan meningkatnya kasus peretasan dan serangan siber di seluruh dunia, profesi ini menjadi sangat vital untuk melindungi infrastruktur penting, data sensitif, dan privasi pengguna.</p>
                </div>',
            ],
            
            // Materi Utama 1 - Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'materi_utama',
                'title' => 'Tugas Utama Cybersecurity Analyst',
                'content' => '<div class="space-y-4">
                    <p>Seorang Cybersecurity Analyst memiliki berbagai tanggung jawab penting:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Monitoring & Detection:</strong> Memantau sistem untuk mendeteksi aktivitas yang mencurigakan secara real-time</li>
                        <li><strong>Security Testing:</strong> Melakukan tes penetrasi dan "ethical hacking" untuk menemukan kelemahan sistem</li>
                        <li><strong>Risk Assessment:</strong> Menganalisis potensi ancaman dan kerentanan dalam infrastruktur IT</li>
                        <li><strong>Security Planning:</strong> Mengembangkan kebijakan dan prosedur keamanan</li>
                        <li><strong>Incident Response:</strong> Menangani dan menyelidiki insiden keamanan ketika terjadi</li>
                        <li><strong>Security Awareness:</strong> Melatih karyawan tentang praktik keamanan yang baik</li>
                    </ul>
                    <p>Tugas mereka bersifat proaktif (mencegah serangan) dan reaktif (merespons serangan yang terjadi).</p>
                </div>',
            ],
            
            // Materi Utama 2 - Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'materi_utama',
                'title' => 'Jenis-jenis Ancaman Siber',
                'content' => '<div class="space-y-4">
                    <p>Cybersecurity Analyst harus memahami berbagai jenis ancaman siber, seperti:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Malware:</strong> Software berbahaya seperti virus, worm, trojan, ransomware yang dapat merusak sistem atau mencuri data</li>
                        <li><strong>Phishing:</strong> Usaha menipu pengguna agar memberikan informasi sensitif seperti password atau detail kartu kredit</li>
                        <li><strong>DDoS (Distributed Denial of Service):</strong> Serangan yang membanjiri sistem dengan traffic untuk melumpuhkan layanan</li>
                        <li><strong>Man-in-the-Middle:</strong> Penyerang menyadap komunikasi antara dua pihak tanpa sepengetahuan mereka</li>
                        <li><strong>Social Engineering:</strong> Manipulasi psikologis untuk membuat orang mengungkapkan informasi rahasia atau melakukan tindakan tertentu</li>
                        <li><strong>SQL Injection:</strong> Menyisipkan kode berbahaya ke database untuk mengakses atau memanipulasi data</li>
                        <li><strong>Zero-day Exploits:</strong> Serangan yang memanfaatkan kerentanan software yang belum diperbaiki</li>
                    </ul>
                    <p>Pemahaman mendalam tentang berbagai jenis serangan ini membantu Cybersecurity Analyst mengembangkan strategi pertahanan yang efektif.</p>
                </div>',
            ],
            
            // Materi Utama 3 - Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'materi_utama',
                'title' => 'Tools dan Teknologi Keamanan',
                'content' => '<div class="space-y-4">
                    <p>Untuk melindungi sistem dan jaringan, Cybersecurity Analyst menggunakan berbagai tools dan teknologi:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Firewall:</strong> Mengontrol lalu lintas jaringan berdasarkan aturan keamanan yang ditetapkan</li>
                        <li><strong>Antivirus/Anti-malware:</strong> Mendeteksi dan menghapus software berbahaya</li>
                        <li><strong>IDS/IPS (Intrusion Detection/Prevention Systems):</strong> Memantau aktivitas jaringan untuk mendeteksi atau mencegah serangan</li>
                        <li><strong>SIEM (Security Information and Event Management):</strong> Mengumpulkan dan menganalisis log keamanan dari berbagai sumber</li>
                        <li><strong>Enkripsi:</strong> Mengubah data menjadi kode rahasia untuk melindungi informasi sensitif</li>
                        <li><strong>VPN (Virtual Private Network):</strong> Menciptakan koneksi aman melalui jaringan publik</li>
                        <li><strong>Penetration Testing Tools:</strong> Seperti Metasploit, Wireshark, atau Nmap untuk menguji keamanan sistem</li>
                        <li><strong>Security Scanners:</strong> Mendeteksi kerentanan dalam sistem atau aplikasi</li>
                    </ul>
                    <p>Menguasai tools ini penting bagi Cybersecurity Analyst untuk melakukan tugasnya dengan efektif.</p>
                </div>',
            ],
            
            // Materi Utama 4 - Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'materi_utama',
                'title' => 'Sertifikasi dan Keterampilan',
                'content' => '<div class="space-y-4">
                    <p>Untuk menjadi Cybersecurity Analyst yang sukses, pengembangan keterampilan dan sertifikasi profesional sangat penting:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Sertifikasi Populer</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>CompTIA Security+:</strong> Sertifikasi dasar yang baik untuk pemula</li>
                        <li><strong>CEH (Certified Ethical Hacker):</strong> Mempelajari cara berpikir dan teknik hacker</li>
                        <li><strong>CISSP (Certified Information Systems Security Professional):</strong> Standar industri untuk profesional keamanan</li>
                        <li><strong>CISA (Certified Information Systems Auditor):</strong> Fokus pada audit keamanan informasi</li>
                        <li><strong>OSCP (Offensive Security Certified Professional):</strong> Sertifikasi hands-on untuk penetration testing</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Kunci</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Pemahaman Jaringan:</strong> Konsep dasar TCP/IP, protokol, arsitektur jaringan</li>
                        <li><strong>Sistem Operasi:</strong> Windows, Linux, Unix</li>
                        <li><strong>Scripting/Pemrograman:</strong> Python, Bash, PowerShell</li>
                        <li><strong>Forensik Digital:</strong> Investigasi insiden keamanan</li>
                        <li><strong>Cloud Security:</strong> Pengamanan lingkungan cloud seperti AWS, Azure, GCP</li>
                        <li><strong>Analisis Risk:</strong> Mengevaluasi dan mengelola risiko keamanan</li>
                        <li><strong>Compliance:</strong> Pengetahuan tentang standar keamanan seperti ISO 27001, GDPR, HIPAA</li>
                    </ul>
                    <p>Kombinasi antara sertifikasi formal, pendidikan, dan pengalaman praktis akan sangat bernilai dalam karir keamanan siber.</p>
                </div>',
            ],
            
            // Materi Utama 5 - Cybersecurity Analyst
            [
                'material_id' => 2,
                'section_type' => 'materi_utama',
                'title' => 'Karir dan Prospek Masa Depan',
                'content' => '<div class="space-y-4">
                    <p>Karir di bidang cybersecurity menawarkan jalur yang beragam dan prospek masa depan yang sangat baik:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Security Analyst → Security Engineer → Security Architect:</strong> Jalur teknis dengan fokus pada desain dan implementasi solusi keamanan</li>
                        <li><strong>Penetration Tester / Ethical Hacker:</strong> Spesialisasi dalam menguji keamanan sistem</li>
                        <li><strong>Security Consultant:</strong> Memberikan saran keamanan kepada berbagai organisasi</li>
                        <li><strong>Digital Forensics Expert:</strong> Menyelidiki insiden dan tindak kejahatan digital</li>
                        <li><strong>CISO (Chief Information Security Officer):</strong> Posisi eksekutif yang bertanggung jawab atas strategi keamanan organisasi</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <p>Cybersecurity Analyst memiliki prospek karir yang sangat menjanjikan karena:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Kesenjangan Tenaga Kerja:</strong> Ada kekurangan besar tenaga ahli keamanan siber di seluruh dunia</li>
                        <li><strong>Gaji Kompetitif:</strong> Pasar yang kekurangan tenaga ahli mendorong gaji yang menarik</li>
                        <li><strong>Peningkatan Serangan:</strong> Frekuensi dan kompleksitas serangan siber terus meningkat</li>
                        <li><strong>Peraturan Keamanan:</strong> Semakin banyak regulasi yang mengharuskan perusahaan berinvestasi di keamanan siber</li>
                        <li><strong>IoT dan Teknologi Baru:</strong> Perluasan perangkat terhubung menciptakan lebih banyak kebutuhan untuk keamanan</li>
                    </ul>
                    <p>Bidang cybersecurity akan terus berkembang seiring dengan evolusi teknologi dan ancaman digital, menjadikannya pilihan karir jangka panjang yang stabil dan dinamis.</p>
                </div>',
            ],
            
            //=========================================================
            // MATERI 3: DATA SCIENTIST
            //=========================================================
            
            // Pengenalan Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'pengenalan',
                'title' => 'Data Ada Di Mana-Mana!',
                'content' => '<div class="space-y-4">
                    <p>Setiap hari, kita menghasilkan banyak sekali data: saat Browse internet, belanja online, bahkan saat menggunakan media sosial.</p>
                    <p>Seorang <strong>Data Scientist</strong> adalah orang yang ahli dalam mengumpulkan, membersihkan, menganalisis, dan menafsirkan data dalam jumlah besar ini untuk menemukan informasi atau pola yang tersembunyi.</p>
                    <p>Mereka seperti detektif yang mencari petunjuk dalam tumpukan data untuk memecahkan misteri atau membuat keputusan penting.</p>
                    <p>Dalam era Big Data ini, kemampuan untuk menganalisis dan mendapatkan wawasan dari data menjadi keterampilan yang sangat berharga di hampir semua industri.</p>
                </div>',
            ],
            
            // Materi Utama 1 - Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'materi_utama',
                'title' => 'Peran dan Tanggung Jawab Data Scientist',
                'content' => '<div class="space-y-4">
                    <p>Data Scientist memiliki beragam peran dan tanggung jawab dalam mengubah data menjadi wawasan yang berharga:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Data Collection:</strong> Mengumpulkan data dari berbagai sumber, baik terstruktur maupun tidak terstruktur</li>
                        <li><strong>Data Cleaning:</strong> Memproses dan membersihkan data dari kesalahan atau inkonsistensi</li>
                        <li><strong>Exploratory Data Analysis (EDA):</strong> Mengeksplorasi data untuk menemukan pola dan hubungan</li>
                        <li><strong>Modeling:</strong> Mengembangkan model statistik dan machine learning untuk analisis prediktif</li>
                        <li><strong>Data Visualization:</strong> Menyajikan temuan dalam bentuk visual yang mudah dipahami</li>
                        <li><strong>Communication:</strong> Menjelaskan temuan kepada stakeholders non-teknis</li>
                        <li><strong>Problem Solving:</strong> Menerapkan wawasan dari data untuk memecahkan masalah bisnis atau penelitian</li>
                    </ul>
                    <p>Peran Data Scientist sering digambarkan sebagai perpaduan antara statistikawan, programmer komputer, dan storyteller bisnis.</p>
                </div>',
            ],
            
            // Materi Utama 2 - Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'materi_utama',
                'title' => 'Tools dan Teknologi Data Science',
                'content' => '<div class="space-y-4">
                    <p>Data Scientist menggunakan berbagai tools dan teknologi untuk mengolah dan menganalisis data:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Bahasa Pemrograman</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Python:</strong> Bahasa paling populer untuk data science dengan library seperti NumPy, Pandas, Scikit-learn, TensorFlow, dan PyTorch</li>
                        <li><strong>R:</strong> Dirancang khusus untuk analisis statistik dan visualisasi data</li>
                        <li><strong>SQL:</strong> Penting untuk mengakses dan mengelola database</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Big Data Technologies</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Hadoop:</strong> Framework untuk pemrosesan data terdistribusi</li>
                        <li><strong>Spark:</strong> Engine pemrosesan data yang lebih cepat dari Hadoop</li>
                        <li><strong>Kafka:</strong> Platform streaming untuk data real-time</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Tools Visualisasi</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Tableau:</strong> Platform visualisasi data yang powerful dan user-friendly</li>
                        <li><strong>Power BI:</strong> Solusi business intelligence dari Microsoft</li>
                        <li><strong>Matplotlib/Seaborn:</strong> Library visualisasi untuk Python</li>
                        <li><strong>D3.js:</strong> Library JavaScript untuk visualisasi data interaktif di web</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Machine Learning Platforms</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Google Cloud AI:</strong> Suite layanan AI dan ML dari Google</li>
                        <li><strong>AWS SageMaker:</strong> Platform machine learning dari Amazon</li>
                        <li><strong>Azure Machine Learning:</strong> Layanan ML dari Microsoft</li>
                    </ul>
                    <p>Menguasai berbagai tools ini memungkinkan Data Scientist untuk menangani berbagai jenis proyek analisis data.</p>
                </div>',
            ],
            
            // Materi Utama 3 - Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'materi_utama',
                'title' => 'Machine Learning dan AI dalam Data Science',
                'content' => '<div class="space-y-4">
                    <p>Machine Learning (ML) dan Artificial Intelligence (AI) adalah komponen penting dalam toolkit Data Scientist modern:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Tipe Machine Learning</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Supervised Learning:</strong> Model dilatih dengan data berlabel untuk membuat prediksi (contoh: klasifikasi email spam, prediksi harga rumah)</li>
                        <li><strong>Unsupervised Learning:</strong> Menemukan pola dalam data tanpa label (contoh: segmentasi pelanggan, deteksi anomali)</li>
                        <li><strong>Reinforcement Learning:</strong> Model belajar melalui trial and error dengan sistem reward (contoh: AI untuk game, robot)</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Algoritma Populer</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Regresi Linear:</strong> Untuk prediksi nilai numerik</li>
                        <li><strong>Decision Trees & Random Forests:</strong> Untuk klasifikasi dan regresi</li>
                        <li><strong>Neural Networks:</strong> Dasar deep learning, bagus untuk masalah kompleks seperti pengenalan gambar atau NLP</li>
                        <li><strong>K-Means:</strong> Untuk clustering dan segmentasi</li>
                        <li><strong>Support Vector Machines:</strong> Untuk klasifikasi dan regresi dengan margin maksimal</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Aplikasi Praktis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Rekomendasi Produk:</strong> Seperti yang digunakan Netflix atau Amazon</li>
                        <li><strong>Natural Language Processing:</strong> Analisis sentimen, chatbots, terjemahan</li>
                        <li><strong>Computer Vision:</strong> Pengenalan gambar, deteksi objek</li>
                        <li><strong>Prediksi Fraud:</strong> Mendeteksi transaksi mencurigakan</li>
                        <li><strong>Forecasting:</strong> Prediksi penjualan, tren pasar, cuaca</li>
                    </ul>
                    <p>Data Scientist perlu memahami kapan dan bagaimana menerapkan algoritma yang tepat untuk masalah tertentu.</p>
                </div>',
            ],
            
            // Materi Utama 4 - Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'materi_utama',
                'title' => 'Keterampilan Penting untuk Data Scientist',
                'content' => '<div class="space-y-4">
                    <p>Menjadi Data Scientist yang efektif membutuhkan kombinasi keterampilan teknis dan non-teknis:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Matematika & Statistika:</strong> Dasar untuk pemahaman algoritma dan analisis data</li>
                        <li><strong>Programming:</strong> Python, R, SQL, dan bahasa lain yang relevan</li>
                        <li><strong>Data Wrangling:</strong> Kemampuan membersihkan, mengubah, dan menyiapkan data</li>
                        <li><strong>Machine Learning:</strong> Memahami berbagai algoritma dan penerapannya</li>
                        <li><strong>Database:</strong> Pengetahuan tentang struktur database dan query</li>
                        <li><strong>Big Data Processing:</strong> Bekerja dengan dataset besar menggunakan tools seperti Spark</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Non-Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Critical Thinking:</strong> Menganalisis masalah secara logis dan sistematis</li>
                        <li><strong>Business Acumen:</strong> Memahami industri dan kebutuhan bisnis</li>
                        <li><strong>Storytelling:</strong> Mengkomunikasikan temuan data dengan cara yang menarik</li>
                        <li><strong>Domain Knowledge:</strong> Pemahaman tentang bidang tempat bekerja (finance, healthcare, retail, dll)</li>
                        <li><strong>Visualisasi Data:</strong> Menyajikan data dengan cara yang jelas dan informatif</li>
                        <li><strong>Pemecahan Masalah:</strong> Menerjemahkan pertanyaan bisnis menjadi masalah data</li>
                    </ul>
                    <p>Seorang Data Scientist yang baik tidak hanya mengerti bagaimana menganalisis data, tetapi juga bagaimana menggunakan hasil analisis untuk memberikan nilai tambah bagi organisasi.</p>
                </div>',
            ],
            
            // Materi Utama 5 - Data Scientist
            [
                'material_id' => 3,
                'section_type' => 'materi_utama',
                'title' => 'Karir dan Prospek sebagai Data Scientist',
                'content' => '<div class="space-y-4">
                    <p>Karir di bidang data science menawarkan jalur pengembangan yang beragam dan prospek yang menjanjikan:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Data Analyst → Data Scientist → Senior Data Scientist:</strong> Jalur umum dengan kompleksitas analisis yang meningkat</li>
                        <li><strong>Machine Learning Engineer:</strong> Fokus pada implementasi dan deployment model ML</li>
                        <li><strong>AI Researcher:</strong> Mengembangkan algoritma dan metode baru</li>
                        <li><strong>Data Science Manager:</strong> Memimpin tim data scientists</li>
                        <li><strong>Chief Data Officer:</strong> Posisi eksekutif yang bertanggung jawab atas strategi data organisasi</li>
                        <li><strong>Data Science Consultant:</strong> Memberikan solusi analitik untuk berbagai klien</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Industri yang Membutuhkan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Tech:</strong> Google, Amazon, Microsoft, dll</li>
                        <li><strong>Finance & Banking:</strong> Untuk analisis risiko, deteksi fraud, algorithmic trading</li>
                        <li><strong>Healthcare:</strong> Untuk diagnosis penyakit, drug discovery, personalized medicine</li>
                        <li><strong>Retail & E-commerce:</strong> Untuk rekomendasi produk, optimasi harga, analisis perilaku konsumen</li>
                        <li><strong>Manufacturing:</strong> Untuk maintenance prediktif, optimasi produksi</li>
                        <li><strong>Entertainment:</strong> Untuk rekomendasi konten, analisis user</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Pertumbuhan Permintaan:</strong> Kebutuhan akan Data Scientist terus meningkat di semua industri</li>
                        <li><strong>Kompensasi Tinggi:</strong> Salah satu profesi dengan bayaran tertinggi dalam bidang teknologi</li>
                        <li><strong>Inovasi Berkelanjutan:</strong> Area yang terus berkembang dengan adanya teknik dan tools baru</li>
                        <li><strong>Dampak Nyata:</strong> Kesempatan untuk menyelesaikan masalah dunia nyata dengan data</li>
                    </ul>
                    <p>Data science akan terus menjadi bidang yang krusial seiring dengan pertumbuhan data dan kebutuhan untuk mengambil keputusan berbasis data.</p>
                </div>',
            ],
            
            //=========================================================
            // MATERI 4: NETWORK ENGINEER
            //=========================================================
            
            // Pengenalan Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'pengenalan',
                'title' => 'Jaringan Komputer: Penghubung Dunia Digital',
                'content' => '<div class="space-y-4">
                    <p>Bayangkan internet sebagai jalan raya super besar yang menghubungkan miliaran komputer dan perangkat di seluruh dunia. Nah, <strong>Network Engineer</strong> adalah orang yang merancang, membangun, dan memelihara "jalan raya" tersebut beserta rambu-rambunya.</p>
                    <p>Mereka memastikan data dapat mengalir dengan cepat, aman, dan tanpa hambatan antara satu perangkat ke perangkat lainnya, baik itu dalam skala kecil (kantor) maupun besar (internet).</p>
                    <p>Dalam era digital ini, hampir semua aspek kehidupan kita bergantung pada konektivitas jaringan yang andal, membuat peran Network Engineer menjadi sangat vital bagi infrastruktur modern.</p>
                </div>',
            ],
            
            // Materi Utama 1 - Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'materi_utama',
                'title' => 'Peran dan Tanggung Jawab Network Engineer',
                'content' => '<div class="space-y-4">
                    <p>Network Engineer memiliki beragam tanggung jawab dalam memastikan jaringan berfungsi dengan baik:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Network Design & Implementation:</strong> Merancang topologi jaringan dan menerapkan infrastruktur fisik dan logis</li>
                        <li><strong>Configuration & Maintenance:</strong> Mengkonfigurasi dan memelihara perangkat jaringan seperti router, switch, firewall</li>
                        <li><strong>Network Monitoring:</strong> Memantau kinerja jaringan dan mendeteksi potensi masalah secara proaktif</li>
                        <li><strong>Troubleshooting:</strong> Mendiagnosis dan menyelesaikan masalah jaringan</li>
                        <li><strong>Security Implementation:</strong> Menerapkan kebijakan keamanan untuk melindungi jaringan dari ancaman</li>
                        <li><strong>Capacity Planning:</strong> Merencanakan perluasan jaringan untuk mengakomodasi pertumbuhan</li>
                        <li><strong>Documentation:</strong> Membuat dan memperbarui dokumentasi infrastruktur jaringan</li>
                        <li><strong>Disaster Recovery:</strong> Merancang dan menerapkan rencana untuk pemulihan dari kegagalan jaringan</li>
                    </ul>
                    <p>Pekerjaan Network Engineer membutuhkan kombinasi dari keterampilan teknis yang kuat dan kemampuan pemecahan masalah yang sistematis.</p>
                </div>',
            ],
            
            // Materi Utama 2 - Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'materi_utama',
                'title' => 'Konsep Dasar Jaringan Komputer',
                'content' => '<div class="space-y-4">
                    <p>Untuk menjadi Network Engineer, perlu memahami beberapa konsep dasar jaringan:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Model OSI dan TCP/IP</h4>
                    <p>Model OSI (7 layer) dan TCP/IP (4 layer) adalah kerangka kerja yang menjelaskan bagaimana data berpindah melalui jaringan.</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Layer Fisik:</strong> Kabel, sinyal, media transmisi</li>
                        <li><strong>Layer Data Link:</strong> MAC addressing, switching</li>
                        <li><strong>Layer Network:</strong> IP addressing, routing</li>
                        <li><strong>Layer Transport:</strong> TCP/UDP, port numbers</li>
                        <li><strong>Layer Aplikasi:</strong> HTTP, FTP, DNS</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Protokol Jaringan Utama</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>IP (Internet Protocol):</strong> Mengatur pengalamatan dan routing paket data</li>
                        <li><strong>TCP (Transmission Control Protocol):</strong> Menyediakan transfer data yang andal</li>
                        <li><strong>UDP (User Datagram Protocol):</strong> Transfer data cepat tanpa koneksi</li>
                        <li><strong>HTTP/HTTPS:</strong> Untuk akses web</li>
                        <li><strong>DNS:</strong> Mengubah nama domain menjadi alamat IP</li>
                        <li><strong>DHCP:</strong> Mengalokasikan alamat IP secara otomatis</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Pengalamatan IP</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>IPv4 vs IPv6:</strong> Format alamat dan perbedaan utama</li>
                        <li><strong>Subnetting:</strong> Membagi jaringan menjadi segmen yang lebih kecil</li>
                        <li><strong>CIDR Notation:</strong> Cara ringkas menuliskan blok alamat IP</li>
                        <li><strong>Public vs Private:</strong> Alamat IP untuk internet vs internal network</li>
                    </ul>
                    <p>Pemahaman mendalam tentang konsep-konsep ini membentuk dasar yang kuat untuk karir sebagai Network Engineer.</p>
                </div>',
            ],
            
            // Materi Utama 3 - Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'materi_utama',
                'title' => 'Perangkat dan Teknologi Jaringan',
                'content' => '<div class="space-y-4">
                    <p>Network Engineer bekerja dengan berbagai perangkat dan teknologi jaringan:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Perangkat Jaringan Inti</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Router:</strong> Menghubungkan jaringan berbeda dan mengarahkan traffic antar jaringan</li>
                        <li><strong>Switch:</strong> Menghubungkan perangkat dalam jaringan yang sama dan meneruskan paket berdasarkan MAC address</li>
                        <li><strong>Firewall:</strong> Menyaring dan mengontrol traffic jaringan berdasarkan aturan keamanan</li>
                        <li><strong>Access Point:</strong> Menyediakan konektivitas nirkabel (Wi-Fi)</li>
                        <li><strong>Load Balancer:</strong> Mendistribusikan traffic secara merata ke beberapa server</li>
                        <li><strong>Proxy Server:</strong> Bertindak sebagai perantara antara client dan server</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Teknologi WAN</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>MPLS (Multiprotocol Label Switching):</strong> Mengarahkan data melalui jalur terpendek</li>
                        <li><strong>SD-WAN (Software-Defined WAN):</strong> Pendekatan software-based untuk manajemen WAN</li>
                        <li><strong>VPN (Virtual Private Network):</strong> Koneksi aman melalui internet publik</li>
                        <li><strong>Leased Lines:</strong> Koneksi point-to-point khusus</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Teknologi Modern</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>SDN (Software-Defined Networking):</strong> Memisahkan control plane dari data plane</li>
                        <li><strong>NFV (Network Function Virtualization):</strong> Virtualisasi fungsi jaringan</li>
                        <li><strong>Network Automation:</strong> Mengotomatisasi konfigurasi dan manajemen jaringan</li>
                        <li><strong>Cloud Networking:</strong> Jaringan dalam lingkungan cloud (AWS, Azure, GCP)</li>
                        <li><strong>5G:</strong> Teknologi jaringan seluler generasi kelima</li>
                        <li><strong>IoT Networking:</strong> Konektivitas untuk perangkat Internet of Things</li>
                    </ul>
                    <p>Network Engineer perlu terus memperbarui pengetahuan mereka seiring perkembangan teknologi jaringan.</p>
                </div>',
            ],
            
            // Materi Utama 4 - Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'materi_utama',
                'title' => 'Keamanan Jaringan',
                'content' => '<div class="space-y-4">
                    <p>Keamanan jaringan adalah aspek kritis dalam pekerjaan Network Engineer:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Ancaman Jaringan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>DDoS (Distributed Denial of Service):</strong> Serangan yang membanjiri jaringan dengan traffic</li>
                        <li><strong>Man-in-the-Middle:</strong> Menyadap komunikasi antar pihak</li>
                        <li><strong>Packet Sniffing:</strong> Mengintip paket data yang lewat di jaringan</li>
                        <li><strong>ARP Poisoning:</strong> Memanipulasi tabel ARP untuk mengalihkan traffic</li>
                        <li><strong>Malware & Ransomware:</strong> Software berbahaya yang menyebar melalui jaringan</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Teknologi Keamanan Jaringan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Firewall:</strong> Melindungi jaringan dengan menyaring traffic</li>
                        <li><strong>IDS/IPS:</strong> Sistem untuk mendeteksi dan mencegah intrusi</li>
                        <li><strong>VPN:</strong> Mengenkripsi komunikasi melalui jaringan publik</li>
                        <li><strong>NAC (Network Access Control):</strong> Membatasi akses ke jaringan berdasarkan kebijakan</li>
                        <li><strong>802.1X:</strong> Standar kontrol akses berdasarkan port</li>
                        <li><strong>Segmentasi Jaringan:</strong> Membagi jaringan menjadi zona keamanan terpisah</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Praktik Keamanan Terbaik</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Defense in Depth:</strong> Menerapkan banyak lapisan pertahanan</li>
                        <li><strong>Principle of Least Privilege:</strong> Hanya memberikan akses minimum yang diperlukan</li>
                        <li><strong>Regular Updates & Patching:</strong> Memperbarui firmware dan software perangkat jaringan</li>
                        <li><strong>Network Monitoring:</strong> Memantau aktivitas jaringan untuk mendeteksi anomali</li>
                        <li><strong>Security Audits:</strong> Pengujian keamanan jaringan secara berkala</li>
                        <li><strong>Incident Response Plan:</strong> Rencana penanganan insiden keamanan</li>
                    </ul>
                    <p>Network Engineer modern harus memadukan keahlian jaringan tradisional dengan pemahaman mendalam tentang keamanan siber.</p>
                </div>',
            ],
            
            // Materi Utama 5 - Network Engineer
            [
                'material_id' => 4,
                'section_type' => 'materi_utama',
                'title' => 'Karir dan Sertifikasi Network Engineer',
                'content' => '<div class="space-y-4">
                    <p>Jalur karir Network Engineer menawarkan banyak kesempatan pengembangan dan spesialisasi:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Junior Network Engineer → Network Engineer → Senior Network Engineer:</strong> Jalur umum dengan tanggung jawab yang meningkat</li>
                        <li><strong>Network Architect:</strong> Merancang solusi jaringan kompleks untuk organisasi besar</li>
                        <li><strong>Network Security Specialist:</strong> Fokus pada aspek keamanan jaringan</li>
                        <li><strong>Cloud Network Engineer:</strong> Spesialisasi dalam jaringan cloud (AWS, Azure, GCP)</li>
                        <li><strong>Network Operations Manager:</strong> Mengawasi tim operasi jaringan</li>
                        <li><strong>Network Automation Engineer:</strong> Fokus pada otomatisasi jaringan</li>
                        <li><strong>CTO/CIO:</strong> Posisi eksekutif untuk bidang teknologi</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Sertifikasi Penting</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Cisco:</strong> CCNA (entry-level), CCNP (professional), CCIE (expert)</li>
                        <li><strong>Juniper:</strong> JNCIA, JNCIS, JNCIP, JNCIE</li>
                        <li><strong>CompTIA:</strong> Network+ (dasar)</li>
                        <li><strong>Microsoft:</strong> Azure Network Engineer Associate</li>
                        <li><strong>AWS:</strong> Advanced Networking Specialty</li>
                        <li><strong>Linux:</strong> LPIC, RHCSA (untuk network administration di Linux)</li>
                        <li><strong>VMware:</strong> NSX certification (jaringan virtualisasi)</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Pertumbuhan 5G & Edge Computing:</strong> Menciptakan kebutuhan baru untuk keahlian jaringan</li>
                        <li><strong>Network Automation:</strong> Peningkatan permintaan untuk keterampilan programming dan otomatisasi</li>
                        <li><strong>Cloud Networking:</strong> Perpindahan ke cloud meningkatkan permintaan untuk keahlian hybrid networking</li>
                        <li><strong>IoT Expansion:</strong> Miliaran perangkat yang terkoneksi membutuhkan desain jaringan yang lebih baik</li>
                        <li><strong>Security Integration:</strong> Jaringan dan keamanan semakin terintegrasi</li>
                    </ul>
                    <p>Network Engineer tetap menjadi profesi yang dicari dan dihargai, dengan kemampuan untuk beradaptasi dengan teknologi baru menjadi kunci kesuksesan jangka panjang.</p>
                </div>',
            ],
            
            //=========================================================
            // MATERI 5: UI/UX DESIGNER
            //=========================================================
            
            // Pengenalan UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'pengenalan',
                'title' => 'Membuat Teknologi Lebih Manusiawi',
                'content' => '<div class="space-y-4">
                    <p>Pernah merasa frustrasi karena sebuah aplikasi sulit digunakan atau tampilannya membingungkan? Di sinilah peran <strong>UI/UX Designer</strong> menjadi penting.</p>
                    <p><strong>UI (User Interface) Designer</strong> fokus pada bagaimana tampilan sebuah produk digital (website, aplikasi) terlihat menarik dan mudah dipahami secara visual. Mereka mengatur tata letak, warna, ikon, dan tipografi.</p>
                    <p><strong>UX (User Experience) Designer</strong> fokus pada bagaimana pengalaman keseluruhan pengguna saat berinteraksi dengan produk tersebut. Mereka memastikan produk mudah digunakan, efisien, dan memberikan kepuasan bagi pengguna.</p>
                    <p>Di era di mana semua orang menggunakan produk digital, UI/UX Designer menjembatani kesenjangan antara manusia dan teknologi, membuat produk digital tidak hanya berfungsi dengan baik tetapi juga menyenangkan untuk digunakan.</p>
                </div>',
            ],
            
            // Materi Utama 1 - UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'materi_utama',
                'title' => 'Perbedaan UI dan UX dalam Desain',
                'content' => '<div class="space-y-4">
                    <p>Meskipun sering disebutkan bersama, UI (User Interface) dan UX (User Experience) adalah dua aspek desain yang berbeda namun saling melengkapi:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">User Interface (UI)</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Definisi:</strong> Desain antarmuka visual yang berinteraksi dengan pengguna</li>
                        <li><strong>Fokus:</strong> Estetika, tampilan, dan interaktivitas</li>
                        <li><strong>Elemen:</strong> Tombol, menu, typography, skema warna, layout, responsivitas, animasi</li>
                        <li><strong>Tujuan:</strong> Membuat produk menarik secara visual dan mudah dinavigasi</li>
                        <li><strong>Pertanyaan kunci:</strong> "Apakah antarmuka ini terlihat baik dan jelas?"</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">User Experience (UX)</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Definisi:</strong> Keseluruhan pengalaman dan perasaan pengguna saat menggunakan produk</li>
                        <li><strong>Fokus:</strong> Fungsionalitas, kegunaan, aksesibilitas, dan kepuasan pengguna</li>
                        <li><strong>Elemen:</strong> User research, information architecture, user flows, wireframing, prototyping, user testing</li>
                        <li><strong>Tujuan:</strong> Memastikan produk berguna, efisien, dan memuaskan pengguna</li>
                        <li><strong>Pertanyaan kunci:</strong> "Apakah produk ini memecahkan masalah pengguna dengan cara yang efektif?"</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Hubungan UI dan UX</h4>
                    <p>UI dan UX bekerja bersama untuk menciptakan produk digital yang sukses:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>UX tanpa UI yang baik: Produk mungkin fungsional tetapi tidak menarik atau intuitif</li>
                        <li>UI tanpa UX yang baik: Produk mungkin indah tetapi sulit digunakan atau tidak memenuhi kebutuhan pengguna</li>
                        <li>UI + UX yang baik: Produk yang secara visual menarik, mudah digunakan, dan memenuhi kebutuhan pengguna</li>
                    </ul>
                    <p>Banyak profesional menguasai kedua aspek ini menjadi "UI/UX Designer", meskipun di perusahaan besar kedua peran ini bisa dipisahkan menjadi spesialisasi terpisah.</p>
                </div>',
            ],
            
            // Materi Utama 2 - UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'materi_utama',
                'title' => 'Proses Desain UI/UX',
                'content' => '<div class="space-y-4">
                    <p>Proses desain UI/UX adalah pendekatan sistematis untuk menciptakan produk digital yang berpusat pada pengguna:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">1. Research & Discovery</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>User Research:</strong> Wawancara, survei, dan observasi pengguna untuk memahami kebutuhan mereka</li>
                        <li><strong>Persona Development:</strong> Menciptakan representasi fiktif dari target pengguna</li>
                        <li><strong>Competitive Analysis:</strong> Menganalisis solusi yang sudah ada di pasar</li>
                        <li><strong>Stakeholder Interviews:</strong> Memahami tujuan bisnis dan teknis</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">2. Planning & Strategy</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>User Stories:</strong> Menentukan apa yang perlu dilakukan pengguna</li>
                        <li><strong>User Flows:</strong> Memetakan perjalanan pengguna melalui produk</li>
                        <li><strong>Information Architecture:</strong> Mengorganisir dan strukturisasi konten</li>
                        <li><strong>Task Analysis:</strong> Memahami langkah-langkah yang diperlukan untuk menyelesaikan suatu tugas</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">3. Design</h4>
                     <ul class="list-disc list-inside space-y-2">
                        <li><strong>Wireframing:</strong> Membuat kerangka dasar (blueprint) dari tata letak antarmuka</li>
                        <li><strong>Mockups:</strong> Desain visual (UI) yang lebih detail dan berwarna</li>
                        <li><strong>Design Systems:</strong> Membuat komponen desain yang konsisten dan dapat digunakan kembali</li>
                    </ul>
                     <h4 class="font-bold text-lg mt-4 mb-2">4. Prototyping & Testing</h4>
                     <ul class="list-disc list-inside space-y-2">
                        <li><strong>Prototyping:</strong> Membuat simulasi interaktif dari produk</li>
                        <li><strong>Usability Testing:</strong> Menguji prototipe dengan pengguna nyata untuk mendapatkan feedback</li>
                        <li><strong>Iteration:</strong> Memperbaiki desain berdasarkan hasil pengujian</li>
                    </ul>
                </div>',
            ],
             // Materi Utama 3 - UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'materi_utama',
                'title' => 'Tools dan Software Populer',
                'content' => '<div class="space-y-4">
                    <p>UI/UX Designer mengandalkan berbagai software untuk mewujudkan ide mereka:</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Design & Prototyping Tools</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Figma:</strong> Alat desain kolaboratif berbasis web yang sangat populer saat ini</li>
                        <li><strong>Sketch:</strong> Aplikasi desain UI untuk macOS yang menjadi standar industri selama bertahun-tahun</li>
                        <li><strong>Adobe XD:</strong> Solusi dari Adobe untuk desain UI/UX dan prototyping</li>
                        <li><strong>InVision:</strong> Platform untuk membuat prototipe interaktif dan mengumpulkan feedback</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Research & Collaboration Tools</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Miro / FigJam:</strong> Papan tulis digital untuk brainstorming dan membuat user flow</li>
                        <li><strong>UserTesting.com:</strong> Platform untuk melakukan usability testing dari jarak jauh</li>
                        <li><strong>Hotjar:</strong> Alat untuk menganalisis perilaku pengguna di website dengan heatmaps dan rekaman sesi</li>
                    </ul>
                </div>',
            ],

            // Materi Utama 4 - UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'materi_utama',
                'title' => 'Keterampilan dan Prinsip Desain',
                'content' => '<div class="space-y-4">
                    <p>Menjadi UI/UX Designer yang handal membutuhkan perpaduan keterampilan kreatif dan analitis.</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Kunci</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Empati:</strong> Kemampuan untuk memahami dan merasakan perspektif pengguna</li>
                        <li><strong>Pemecahan Masalah:</strong> Mengidentifikasi masalah pengguna dan menemukan solusi desain yang efektif</li>
                        <li><strong>Komunikasi Visual:</strong> Menggunakan elemen visual untuk menyampaikan informasi secara jelas</li>
                        <li><strong>Wireframing & Prototyping:</strong> Kemampuan untuk membuat kerangka dan model interaktif</li>
                        <li><strong>User Research & Testing:</strong> Mengumpulkan dan menganalisis data dari pengguna</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prinsip Desain Penting</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Hierarchy:</strong> Mengatur elemen untuk menunjukkan tingkat kepentingan</li>
                        <li><strong>Consistency:</strong> Menjaga elemen desain tetap seragam di seluruh produk</li>
                        <li><strong>Feedback:</strong> Memberi tahu pengguna hasil dari tindakan mereka</li>
                        <li><strong>Usability:</strong> Memastikan produk mudah digunakan dan dipelajari</li>
                        <li><strong>Accessibility:</strong> Merancang produk yang dapat digunakan oleh semua orang, termasuk penyandang disabilitas</li>
                    </ul>
                </div>',
            ],

            // Materi Utama 5 - UI/UX Designer
            [
                'material_id' => 5,
                'section_type' => 'materi_utama',
                'title' => 'Karir dan Prospek sebagai UI/UX Designer',
                'content' => '<div class="space-y-4">
                    <p>Karir di bidang UI/UX sangat menjanjikan dan terus berkembang seiring meningkatnya fokus pada pengalaman digital.</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Junior UI/UX Designer → Mid-level → Senior UI/UX Designer:</strong> Jalur pertumbuhan umum</li>
                        <li><strong>UX Researcher:</strong> Spesialisasi dalam riset pengguna dan analisis data</li>
                        <li><strong>Interaction Designer:</strong> Fokus pada bagaimana pengguna berinteraksi dengan produk</li>
                        <li><strong>Product Designer:</strong> Peran yang lebih luas, menggabungkan UI/UX dengan strategi produk</li>
                        <li><strong>Design Lead / Manager:</strong> Memimpin tim desain dan strategi</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Permintaan Sangat Tinggi:</strong> Hampir semua perusahaan teknologi membutuhkan desainer untuk menciptakan produk yang unggul.</li>
                        <li><strong>Gaji Kompetitif:</strong> Peran yang sangat dihargai dengan kompensasi yang menarik.</li>
                        <li><strong>Dampak Langsung:</strong> Hasil kerja langsung dirasakan oleh pengguna akhir.</li>
                        <li><strong>Peluang Berkembang:</strong> Bidang yang terus berevolusi dengan munculnya teknologi baru seperti AR/VR dan AI.</li>
                    </ul>
                </div>',
            ],

            //=========================================================
            // MATERI 6: IT CONSULTANT
            //=========================================================
            
            // Pengenalan IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'pengenalan',
                'title' => 'Penasihat Strategis di Dunia Teknologi',
                'content' => '<div class="space-y-4">
                    <p>Sebuah perusahaan ingin pindah ke cloud, meningkatkan keamanannya, atau menerapkan sistem ERP baru, tetapi mereka tidak tahu harus mulai dari mana. Di sinilah seorang <strong>IT Consultant</strong> masuk.</p>
                    <p>IT Consultant adalah seorang ahli eksternal yang memberikan saran strategis kepada bisnis tentang cara terbaik memanfaatkan teknologi untuk mencapai tujuan mereka. Mereka adalah jembatan antara teknologi dan bisnis.</p>
                    <p>Mereka tidak hanya memahami teknologi secara mendalam, tetapi juga mengerti bagaimana teknologi dapat digunakan untuk meningkatkan efisiensi, mengurangi biaya, dan menciptakan keunggulan kompetitif.</p>
                </div>',
            ],
            
            // Materi Utama 1 - IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'materi_utama',
                'title' => 'Peran dan Tanggung Jawab IT Consultant',
                'content' => '<div class="space-y-4">
                    <p>Peran seorang konsultan bersifat analitis, strategis, dan berorientasi pada proyek:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Analisis Kebutuhan Klien:</strong> Melakukan workshop dan wawancara untuk memahami masalah dan tujuan bisnis klien.</li>
                        <li><strong>Audit Sistem Saat Ini:</strong> Menganalisis infrastruktur dan proses IT yang ada untuk menemukan kelemahan dan peluang perbaikan.</li>
                        <li><strong>Memberikan Rekomendasi Strategis:</strong> Mengusulkan solusi teknologi (misalnya software, hardware, atau perubahan proses) yang paling sesuai.</li>
                        <li><strong>Manajemen Proyek:</strong> Seringkali, konsultan juga mengawasi implementasi solusi yang mereka rekomendasikan.</li>
                        <li><strong>Pelatihan dan Transfer Pengetahuan:</strong> Melatih staf klien untuk menggunakan sistem baru.</li>
                        <li><strong>Tetap Update dengan Tren:</strong> Selalu mengikuti perkembangan teknologi terbaru untuk memberikan saran yang relevan.</li>
                    </ul>
                </div>',
            ],
            
            // Materi Utama 2 - IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'materi_utama',
                'title' => 'Area Spesialisasi IT Consultant',
                'content' => '<div class="space-y-4">
                    <p>IT Consulting adalah bidang yang luas. Banyak konsultan memilih untuk berspesialisasi di area tertentu:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Cybersecurity Consulting:</strong> Memberikan saran tentang cara melindungi aset digital dan mematuhi peraturan keamanan.</li>
                        <li><strong>Cloud Consulting:</strong> Membantu perusahaan merencanakan dan melaksanakan migrasi ke platform cloud seperti AWS, Azure, atau GCP.</li>
                        <li><strong>ERP (Enterprise Resource Planning) Consulting:</strong> Spesialisasi dalam implementasi sistem besar seperti SAP, Oracle, atau Microsoft Dynamics.</li>
                        <li><strong>Data & Analytics Consulting:</strong> Membantu perusahaan memanfaatkan data mereka untuk pengambilan keputusan yang lebih baik.</li>
                        <li><strong>IT Strategy Consulting:</strong> Bekerja di level eksekutif untuk menyelaraskan strategi IT dengan strategi bisnis secara keseluruhan.</li>
                        <li><strong>Digital Transformation Consulting:</strong> Membantu bisnis tradisional beradaptasi dengan era digital.</li>
                    </ul>
                </div>',
            ],

            // Materi Utama 3 - IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'materi_utama',
                'title' => 'Proses Kerja Seorang Konsultan',
                'content' => '<div class="space-y-4">
                    <p>Sebuah proyek konsultasi biasanya mengikuti siklus hidup yang terstruktur:</p>
                    <ol class="list-decimal list-inside space-y-2">
                        <li><strong>Discovery (Penemuan):</strong> Fase awal untuk memahami masalah klien, ruang lingkup proyek, dan tujuan yang ingin dicapai.</li>
                        <li><strong>Analysis (Analisis):</strong> Mengumpulkan data, menganalisis sistem dan proses yang ada, serta mengidentifikasi akar masalah.</li>
                        <li><strong>Recommendation (Rekomendasi):</strong> Mengembangkan beberapa opsi solusi, mengevaluasi pro dan kontranya, dan menyajikan rekomendasi terbaik kepada klien dalam bentuk proposal atau presentasi.</li>
                        <li><strong>Implementation (Implementasi):</strong> Bekerja dengan tim klien (atau tim sendiri) untuk menerapkan solusi yang direkomendasikan. Ini bisa berupa instalasi software, konfigurasi sistem, atau perubahan proses kerja.</li>
                        <li><strong>Evaluation (Evaluasi):</strong> Setelah implementasi, konsultan mengukur keberhasilan proyek berdasarkan metrik yang telah disepakati dan memastikan solusi berjalan sesuai harapan.</li>
                    </ol>
                </div>',
            ],

            // Materi Utama 4 - IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'materi_utama',
                'title' => 'Keterampilan Kunci IT Consultant',
                'content' => '<div class="space-y-4">
                    <p>Konsultan yang sukses adalah perpaduan unik antara seorang teknisi, pebisnis, dan komunikator.</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Keahlian Mendalam:</strong> Pengetahuan tingkat ahli di area spesialisasi (misalnya, keamanan, cloud, data).</li>
                        <li><strong>Pemahaman Arsitektur Sistem:</strong> Mampu melihat gambaran besar tentang bagaimana berbagai sistem teknologi berinteraksi.</li>
                        <li><strong>Manajemen Proyek:</strong> Keterampilan untuk merencanakan, melaksanakan, dan menyelesaikan proyek tepat waktu dan sesuai anggaran.</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Keterampilan Non-Teknis</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Pemahaman Bisnis (Business Acumen):</strong> Kemampuan untuk memahami bagaimana sebuah bisnis beroperasi dan menghasilkan uang.</li>
                        <li><strong>Komunikasi & Presentasi:</strong> Mampu menjelaskan konsep teknis yang rumit kepada audiens non-teknis (seperti CEO atau CFO) dengan cara yang meyakinkan.</li>
                        <li><strong>Kemampuan Analitis & Pemecahan Masalah:</strong> Mampu memecah masalah besar menjadi bagian-bagian yang dapat dikelola.</li>
                        <li><strong>Membangun Hubungan:</strong> Kepercayaan adalah kunci dalam konsultasi. Kemampuan untuk membangun hubungan baik dengan klien sangat penting.</li>
                    </ul>
                </div>',
            ],

            // Materi Utama 5 - IT Consultant
            [
                'material_id' => 6,
                'section_type' => 'materi_utama',
                'title' => 'Jalur Karir dan Prospek',
                'content' => '<div class="space-y-4">
                    <p>Karir di bidang IT consulting bisa sangat menantang namun juga sangat memuaskan, baik secara finansial maupun profesional.</p>
                    <h4 class="font-bold text-lg mt-4 mb-2">Jalur Karir</h4>
                    <p>Biasanya dimulai dari perusahaan konsultan besar (seperti Accenture, Deloitte, PwC, EY) atau butik konsultan yang lebih kecil.</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Analyst → Consultant → Senior Consultant → Manager → Senior Manager → Partner/Director.</strong></li>
                        <li><strong>Freelance/Independent Consultant:</strong> Setelah memiliki banyak pengalaman dan jaringan, banyak konsultan memilih untuk bekerja secara mandiri.</li>
                        <li><strong>Pindah ke Industri:</strong> Banyak klien merekrut konsultan yang mereka sukai untuk menjadi karyawan tetap di posisi senior (misalnya, CIO atau Head of IT).</li>
                    </ul>
                    <h4 class="font-bold text-lg mt-4 mb-2">Prospek Masa Depan</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Selalu Dibutuhkan:</strong> Selama teknologi terus berkembang, perusahaan akan selalu membutuhkan ahli untuk membantu mereka menavigasi perubahan.</li>
                        <li><strong>Kompensasi Tinggi:</strong> IT Consulting adalah salah satu jalur karir dengan bayaran tertinggi di industri teknologi.</li>
                        <li><strong>Pembelajaran Cepat:</strong> Terpapar pada berbagai industri, masalah, dan teknologi dalam waktu singkat.</li>
                        <li><strong>Jaringan Luas:</strong> Kesempatan untuk membangun jaringan profesional di level eksekutif.</li>
                    </ul>
                </div>',
            ],
        ];

        foreach ($contents as $key => $content) {
            // Remove 'audio_text'
            unset($contents[$key]['audio_text']);

            // Remove the answer paragraph if it's a 'latihan' section
            if ($content['section_type'] === 'latihan' && isset($content['content'])) {
                $contents[$key]['content'] = preg_replace('/<p class="text-sm text-gray-600 mt-2">Jawaban:.*?<\/p>/s', '', $content['content']);
            }
        }

        foreach ($contents as $content) {
            MaterialContent::create($content);
        }
    }
}

// php artisan db:seed --class=MaterialContentSeeder

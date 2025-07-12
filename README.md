<h1 align="center">Elkaris</h1>

⚠️ **Catatan Penting** ⚠️  
Saat ini, untuk menjalankan proyek secara lokal dan memastikan semua fitur berfungsi dengan baik, pastikan _database_ Anda telah terkonfigurasi dan _server_ lokal (seperti Laragon, XAMPP, atau WAMP) berjalan.

---

### 🚀 Langkah-Langkah Instalasi Lokal

1.  **Clone Repository:**
    ```bash
    git clone https://github.com/mfachri88/elkaris.git . 
    # atau URL repository Anda jika berbeda
    ```
    Pindahkan ke direktori proyek:
    ```bash
    cd elkaris 
    # atau nama direktori proyek Anda
    ```

2.  **Install Dependensi:**
    Pastikan Anda memiliki Composer dan Node.js terinstal.
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment:**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    copy .env.example .env
    ```
    Buka file `.env` dan konfigurasikan detail koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD, dll.).

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi dan Seeding Database:**
    Perintah ini akan membuat struktur tabel dan mengisi data awal yang diperlukan.
    ```bash
    php artisan migrate:refresh --seed
    ```

6.  **Storage Link:**
    Perintah ini akan membuat _symlink_ untuk _storage_ publik.
    ```bash
    php artisan storage:link
    ```

7.  **Compile Assets (jika menggunakan Vite/Mix):**
    ```bash
    npm run dev 
    # atau npm run build untuk production
    ```

8.  **Jalankan Server Development:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan secara default di `http://127.0.0.1:8000`.

---

### 🔑 Akses Akun Default

<p align="justify">
Untuk mengakses platform dengan data contoh, Anda dapat menggunakan kredensial berikut pada halaman <i>Login</i>:
</p>

*   **Admin:**
    *   Email: `admin@elkaris.com`
    *   Password: `admin123`
*   **Pengguna Siswa:**
    *   Email: `budi.santoso@example.com` 
    *   Password: `siswa123`

---



<p align="justify">
<strong>Elkaris</strong> adalah sebuah <i>platform</i> pembelajaran digital interaktif yang dirancang untuk menyediakan berbagai macam materi pengenalan profesi IT yang menarik. Fokus utama kami adalah membantu anak anak yang bimbang memilih prospek karir dimasa depan. Kami percaya bahwa setiap individu berhak mendapatkan akses ke pembelajaran yang menyenangkan dan efektif, sesuai dengan cita-cita mencerdaskan kehidupan bangsa.
</p>

<br />

---

### 🛠️ _Tech Stack_ yang Digunakan

-   **Backend:** Laravel (PHP Framework)
-   **Frontend:** Blade Templates, Tailwind CSS, JavaScript
-   **Database:** MySQL
-   **JavaScript Libraries & Tools:**
    -   Chart.js (untuk visualisasi data dan grafik)
    -   Quill.js (sebagai editor teks kaya / WYSIWYG)
    -   Font Awesome (untuk ikonografi)
    -   Moment.js (untuk manipulasi dan format tanggal)
    -   SpeechSynthesis API (untuk fitur Text-to-Speech)
    -   Vite (untuk _asset bundling_)

<br />

---

### ✨ Fitur dan Menu Utama

**Untuk Pengguna (Siswa):**

-   **Beranda:** Halaman utama dengan ringkasan dan akses cepat.
-   **Materi Pembelajaran:** Modul interaktif yang terstruktur ke dalam beberapa bagian (Pengenalan, Materi Utama, Latihan).
    -   Konten multimedia (gambar, audio).
-   **Latihan Soal:** Kumpulan soal untuk menguji pemahaman materi.
    -   Sistem penilaian otomatis.
    -   Penyimpanan riwayat pengerjaan.
-   **Progres Belajar:** Visualisasi perkembangan belajar pengguna melalui grafik (Pie Chart) dan daftar aktivitas terakhir.
-   **Preferensi Pengguna:** Pengaturan personalisasi akun dan tampilan.
    -   Penyesuaian ukuran font untuk aksesibilitas.
-   **Notifikasi:** Pemberitahuan terkait aktivitas belajar, materi baru, atau pengumuman.
-   **Chatbot:** Fitur interaktif dengan AI yang bisa merespon segala pertanyaan siswa terkait karir IT.
-   **Tes Minat Bakat Karir:** Fitur untuk membantu pengguna mengenali potensi karir.

**Untuk Admin:**

-   **Dashboard Admin:** Ringkasan statistik platform.
-   **Manajemen Pengguna:**
    -   Tambah, edit, hapus, dan lihat detail pengguna.
    -   Pantau aktivitas dan progres belajar pengguna.
-   **Manajemen Materi:**
    -   Tambah, edit, hapus materi pembelajaran.
    -   Kelola konten materi per bagian (pengenalan, materi utama, latihan) menggunakan editor teks kaya.
    -   Unggah gambar pendukung.
    -   Atur status aktif/nonaktif materi.
-   **Manajemen Latihan Soal:**
    -   Tambah, edit, hapus paket latihan soal.
    -   Kelola pertanyaan dalam setiap paket latihan, termasuk opsi jawaban dan kunci jawaban.
-   **Laporan Statistik:**
    -   Visualisasi data performa platform, aktivitas pengguna, dan progres pembelajaran secara keseluruhan.
    -   Grafik tren aktivitas harian/bulanan.

<br />

---
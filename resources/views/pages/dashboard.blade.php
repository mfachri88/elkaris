@component("layouts.main-layout", [
    "judul" => "Beranda", 
    "deskripsi" => "Selamat datang di Elkaris, platform pembelajaran yang menyediakan berbagai materi informatif untuk pengenalan karir IT.", 
    "halaman_khusus" => false
])
    <main class="min-h-screen px-6 bg-white">
        @include("components.dashboard.selamat-datang")
        @include("components.dashboard.menu-utama") 
        @include("components.dashboard.statistik")
    </main>
@endcomponent
@component("layouts.main-layout", [
    "judul" => "Hasil Tes Minat Bakat",
    "deskripsi" => "Hasil analisis tes minat bakat Anda"
])
<main class="min-h-screen px-6 py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden border-4 border-blue-100">
        <header class="bg-blue-50 border-b-4 border-blue-100 p-6">
            <h1 class="text-3xl font-bold text-gray-800">Hasil Tes Minat Bakat</h1>
            <p class="text-gray-600 mt-2">Berikut adalah hasil analisis dari tes minat bakat yang telah Anda lakukan.</p>
            <p class="text-sm text-gray-500 mt-2">Diambil pada: {{ $testResult->created_at->format('d F Y, H:i') }}</p>
        </header>
        
        <section class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Profil Minat Anda</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @foreach($results as $category => $score)
                    @if(isset($categories[$category]))
                        <div class="border-2 rounded-xl p-4 {{ $highestCategory == $category ? 'border-'.$categories[$category]['color'].'-400 bg-'.$categories[$category]['color'].'-50' : 'border-gray-200' }}">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas {{ $categories[$category]['icon'] }} text-{{ $categories[$category]['color'] }}-500 bg-{{ $categories[$category]['color'] }}-100 p-3 rounded-lg"></i>
                                <h3 class="text-xl font-semibold">{{ $categories[$category]['name'] }}</h3>
                                @if($highestCategory == $category)
                                    <span class="bg-{{ $categories[$category]['color'] }}-100 text-{{ $categories[$category]['color'] }}-700 text-xs px-2 py-1 rounded-full">Tertinggi</span>
                                @endif
                            </div>
                            
                            <div class="mb-2">
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-{{ $categories[$category]['color'] }}-500 h-3 rounded-full" style="width: {{ $score }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 mt-1">
                                    <span>0%</span>
                                    <span>{{ $score }}%</span>
                                    <span>100%</span>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 text-sm">{{ $categories[$category]['description'] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
            
            @if((isset($metadata['strengths']) && count($metadata['strengths']) > 0) || isset($recommendations['careers']) || (isset($recommendations['studies']) && count($recommendations['studies']) > 0) )
                <div class="border-2 border-{{ $categories[$highestCategory]['color'] ?? 'gray' }}-400 rounded-xl p-6 bg-{{ $categories[$highestCategory]['color'] ?? 'gray' }}-50 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Rekomendasi untuk Anda</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-{{ $categories[$highestCategory]['color'] ?? 'gray' }}-700 mb-2">
                                <i class="fas fa-briefcase mr-2"></i>Karir yang Direkomendasikan
                            </h3>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                @php
                                    $displayedCareers = [];
                                    if (isset($metadata['strengths']) && count($metadata['strengths']) > 0 && isset($careerDescriptions[$highestCategory]['career_paths'])) {
                                        $displayedCareers = $careerDescriptions[$highestCategory]['career_paths'];
                                    } elseif (isset($recommendations['careers']) && count($recommendations['careers']) > 0) {
                                        $displayedCareers = $recommendations['careers'];
                                    }
                                @endphp
                                @if(count($displayedCareers) > 0)
                                    @foreach($displayedCareers as $career)
                                        <li>{{ $career }}</li>
                                    @endforeach
                                @else
                                    <li>Belum ada rekomendasi karir spesifik.</li>
                                @endif
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-{{ $categories[$highestCategory]['color'] ?? 'gray' }}-700 mb-2">
                                <i class="fas fa-graduation-cap mr-2"></i>Bidang Studi yang Direkomendasikan
                            </h3>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                {{-- --- PERBAIKAN DIMULAI DI SINI --- --}}
                                @if(isset($recommendations['studies']) && count($recommendations['studies']) > 0)
                                    @foreach($recommendations['studies'] as $study)
                                        <li>{{ $study }}</li>
                                    @endforeach
                                @else
                                    <li>Saat ini belum ada rekomendasi bidang studi spesifik untuk kategori ini.</li>
                                @endif
                                {{-- --- PERBAIKAN SELESAI DI SINI --- --}}
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="border-2 border-gray-200 rounded-xl p-6 bg-gray-50">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pengembangan Diri</h2>
                <p class="text-gray-700 mb-4">
                    Hasil tes ini hanyalah panduan untuk membantu Anda mengenali potensi dan minat Anda. Anda tetap memiliki kemampuan
                    untuk mengembangkan diri di berbagai bidang. Teruslah belajar dan eksplorasi minat Anda untuk menemukan jalur
                    yang paling sesuai dengan kepribadian dan aspirasi Anda.
                </p>
                <p class="text-gray-700">
                    Konsultasikan hasil ini dengan guru, konselor pendidikan, atau mentor untuk mendapatkan panduan lebih lanjut
                    tentang pengembangan karir dan pendidikan Anda.
                </p>
            </div>
        </section>
        
        <footer class="bg-gray-50 p-6 border-t border-gray-200 flex justify-between">
            <div>
                <a href="{{ route('tes-minat-bakat') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors mr-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('tes-minat-bakat.history') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-history"></i>
                    Riwayat Tes
                </a>
            </div>
            
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-print"></i>
                Cetak Hasil
            </button>
        </footer>
    </div>
</main>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        main, main * {
            visibility: visible;
        }
        main {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        footer, button {
            display: none !important;
        }
    }
</style>
@endcomponent
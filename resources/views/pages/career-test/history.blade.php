@component("layouts.main-layout", [
    "judul" => "Riwayat Tes Minat Bakat",
    "deskripsi" => "Riwayat hasil tes minat bakat Anda"
])

<main class="min-h-screen px-4 py-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Tes Minat Bakat</h1>
        
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">
                    Berikut adalah riwayat tes minat bakat yang telah Anda lakukan.
                </p>
                <a href="{{ route('tes-minat-bakat') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Ambil Tes Baru
                </a>
            </div>
            
            @if($testResults->isEmpty())
                <div class="text-center py-8">
                    <i class="fas fa-history text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Anda belum pernah mengambil tes minat bakat.</p>
                    <a href="{{ route('tes-minat-bakat') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Ambil Tes Sekarang
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Tes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hasil Utama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Skor Tertinggi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($testResults as $result)
                                @php
                                    $warna = [
                                        'software_developer' => 'blue',
                                        'data_scientist' => 'purple',
                                        'network_engineer' => 'green',
                                        'ui_ux_designer' => 'pink',
                                        'cybersecurity_analyst' => 'red',
                                        'it_consultant' => 'cyan'
                                    ];
                                    $warna = $warna[$result->result] ?? 'gray';
                                    $skorTertinggi = max([
                                        $result->software_developer,
                                        $result->data_scientist,
                                        $result->network_engineer,
                                        $result->ui_ux_designer,
                                        $result->cybersecurity_analyst,
                                        $result->it_consultant
                                    ]);
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $result->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $warna }}-100 text-{{ $warna }}-800">
                                            {{ $careerDescriptions[$result->result]['title'] ?? 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $skorTertinggi }}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('tes-minat-bakat.result', $result->id) }}" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-eye mr-1"></i> Lihat Hasil
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</main>

@endcomponent

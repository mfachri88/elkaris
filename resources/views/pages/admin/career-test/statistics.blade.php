@component("layouts.admin-layout", [
    "judul" => "Statistik Tes Minat Bakat",
    "deskripsi" => "Statistik dan analisis tes minat bakat"
])
<main class="container mx-auto">
    <section class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Statistik Tes Minat Bakat</h1>
            <a href="{{ route('admin.career-test.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
        <p class="text-gray-600 mt-2">Analisis statistik hasil tes minat bakat pengguna</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-blue-500">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Total Tes</h3>
            <p class="text-3xl font-bold text-blue-500">{{ $totalTests }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-green-500">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Tes Bulan Ini</h3>
            @php
                $currentMonth = date('M Y');
                $thisMonthTests = $monthlyTestData[$currentMonth] ?? 0;
            @endphp
            <p class="text-3xl font-bold text-green-500">{{ $thisMonthTests }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-purple-500">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Karir Terpopuler</h3>
            @php
                $maxCareer = '';
                $maxCount = 0;
                foreach ($distribution as $career => $data) {
                    if ($data['count'] > $maxCount) {
                        $maxCount = $data['count'];
                        $maxCareer = $career;
                    }
                }
                $careerTitle = $maxCareer ? $careerDescriptions[$maxCareer]['title'] : 'N/A';
            @endphp
            <p class="text-xl font-bold text-purple-500">{{ $careerTitle }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-amber-500">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Rata-rata Tertinggi</h3>
            @php
                $maxAvg = 0;
                $maxAvgCareer = '';
                foreach ($averageScores as $career => $avg) {
                    if ($avg > $maxAvg) {
                        $maxAvg = $avg;
                        $maxAvgCareer = $career;
                    }
                }
                $avgCareerTitle = $maxAvgCareer ? $careerDescriptions[$maxAvgCareer]['title'] : 'N/A';
            @endphp
            <p class="text-xl font-bold text-amber-500">{{ $avgCareerTitle }} ({{ round($maxAvg) }}%)</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Distribusi Karir Chart -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Distribusi Hasil Karir</h3>
            <div class="h-80">
                <canvas id="careerDistributionChart"></canvas>
            </div>
        </div>
        
        <!-- Skor Rata-rata Chart -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Skor Rata-rata Per Karir</h3>
            <div class="h-80">
                <canvas id="averageScoresChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Aktivitas Test Chart -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-10">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Aktivitas Tes Bulanan</h3>
        <div class="h-80">
            <canvas id="monthlyActivityChart"></canvas>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Define colors for all careers
            const careerColors = {
                'software_developer': '#3b82f6', // blue
                'data_scientist': '#8b5cf6', // purple
                'network_engineer': '#22c55e', // green
                'ui_ux_designer': '#ec4899', // pink
                'cybersecurity_analyst': '#ef4444', // red
                'machine_learning_engineer': '#6366f1', // indigo
                'iot_engineer': '#eab308', // yellow
                'data_analyst': '#84cc16', // lime
                'data_engineer': '#14b8a6', // teal
                'it_consultant': '#06b6d4', // cyan
                'mobile_developer': '#f97316', // orange
                'devops_engineer': '#c026d3', // fuchsia
                'system_engineer': '#e11d48', // rose
                'cloud_engineer': '#0ea5e9', // sky
            };
            
            // Get all careers data
            const distributionData = @json($distribution);
            const averageScoresData = @json($averageScores);
            const careerDescriptions = @json($careerDescriptions);
            
            // Create arrays for charts
            const careerNames = Object.keys(distributionData);
            const labels = careerNames.map(career => careerDescriptions[career].title);
            const colors = careerNames.map(career => careerColors[career] || '#6b7280'); // gray fallback
            const counts = careerNames.map(career => distributionData[career].count);
            const percentages = careerNames.map(career => distributionData[career].percentage);
            const averages = careerNames.map(career => averageScoresData[career]);
            
            // Distribution Chart
            const distributionCtx = document.getElementById('careerDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const percentage = percentages[context.dataIndex];
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            
            // Average Scores Chart
            const averageCtx = document.getElementById('averageScoresChart').getContext('2d');
            new Chart(averageCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Rata-rata Skor (%)',
                        data: averages,
                        backgroundColor: colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            
            // Monthly Activity Chart
            const monthlyCtx = document.getElementById('monthlyActivityChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: [
                        @foreach($monthlyTestData as $month => $count)
                            '{{ $month }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah Tes',
                        data: [
                            @foreach($monthlyTestData as $month => $count)
                                {{ $count }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
</main>
@endcomponent
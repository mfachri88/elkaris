
<main class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <section id="loading-state" class="col-span-1 lg:col-span-2 flex justify-center items-center py-12">
        <div class="flex flex-col items-center gap-4">
            <span class="animate-spin h-12 w-12 border-4 border-[#f58a66] border-t-transparent rounded-full"></span>
            <p class="text-gray-600">Memuat data...</p>
        </div>
    </section>

    <section id="content-state" class="hidden col-span-1 lg:col-span-2">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Progress Chart --}}
            <article class="bg-white p-6 rounded-xl border-4 border-[#f58a66]/20 shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-chart-pie mr-2 text-[#f58a66]"></i>Progress Overview
                </h3>
                <div class="relative h-64">
                    <canvas id="progressChart" width="400" height="400"></canvas>
                    @if($completedPercentage == 0 && $inProgressPercentage == 0 && $notStartedPercentage == 100)
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-gray-500">Belum ada progress</p>
                        </div>
                    @endif
                </div>
                
                {{-- Legend Manual --}}
                <div class="mt-4 space-y-2">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-green-500 rounded"></div>
                        <span class="text-sm text-gray-600">Selesai ({{ $completedPercentage }}%)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                        <span class="text-sm text-gray-600">Dalam Progress ({{ $inProgressPercentage }}%)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-gray-300 rounded"></div>
                        <span class="text-sm text-gray-600">Belum Dimulai ({{ $notStartedPercentage }}%)</span>
                    </div>
                </div>
            </article>

            {{-- Recent Activities --}}
            <article class="bg-white p-6 rounded-xl border-4 border-[#f58a66]/20 shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-history mr-2 text-[#f58a66]"></i>Aktivitas Terakhir
                </h3>
                @if (!isset($recentActivities) || $recentActivities->isEmpty())
                    <div class="flex items-center justify-center p-4 rounded-xl gap-2">
                        <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        <h5 class="text-gray-500">Belum ada aktivitas terakhir</h5>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <figure class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <i class="fas {{ $activity->icon }} bg-{{ $activity->color }}-100 p-3 rounded-lg text-{{ $activity->color }}-500"></i>
                                    <span>
                                        <h4 class="font-semibold text-gray-800">{{ $activity->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $activity->description }}</p>
                                    </span>
                                </div>
                                <time class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($activity->completed_at)->diffForHumans() }}
                                </time>
                            </figure>
                        @endforeach
                    </div>
                @endif
            </article>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Progress page loaded');
        
        // Debug data
        console.log('Chart data:', {
            completed: {{ $completedPercentage }},
            inProgress: {{ $inProgressPercentage }},
            notStarted: {{ $notStartedPercentage }}
        });

        // Check if Chart.js is loaded
        if (typeof Chart === 'undefined') {
            console.error('Chart.js is not loaded!');
            document.getElementById('loading-state').innerHTML = `
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                    <p class="text-red-600">Chart.js library tidak dimuat</p>
                </div>
            `;
            return;
        }

        setTimeout(() => {
            try {
                // Hide loading, show content
                document.getElementById('loading-state').classList.add('hidden');
                document.getElementById('content-state').classList.remove('hidden');
                
                // Get canvas element
                const canvas = document.getElementById('progressChart');
                if (!canvas) {
                    console.error('Canvas element not found!');
                    return;
                }

                // ✅ PERBAIKAN: Destroy existing chart jika ada
                const existingChart = Chart.getChart(canvas);
                if (existingChart) {
                    console.log('Destroying existing chart...');
                    existingChart.destroy();
                }

                // Create new chart
                const ctx = canvas.getContext('2d');
                
                const progressChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Selesai', 'Dalam Progress', 'Belum Dimulai'],
                        datasets: [{
                            data: [
                                {{ $completedPercentage }}, 
                                {{ $inProgressPercentage }}, 
                                {{ $notStartedPercentage }}
                            ],
                            backgroundColor: ['#22c55e', '#f59e0b', '#e5e7eb'],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                display: false // Hide default legend, kita pakai manual
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.parsed}%`;
                                    }
                                }
                            }
                        },
                        animation: { 
                            animateScale: true, 
                            animateRotate: true,
                            duration: 1500
                        }
                    }
                });

                console.log('Chart created successfully:', progressChart);

                // ✅ PERBAIKAN: Simpan referensi chart untuk cleanup
                window.progressChartInstance = progressChart;

            } catch (error) {
                console.error('Error creating chart:', error);
                document.getElementById('content-state').innerHTML = `
                    <div class="col-span-1 lg:col-span-2 text-center p-8">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-600">Gagal memuat chart: ${error.message}</p>
                    </div>
                `;
            }
        }, 1000);
    });

    // ✅ PERBAIKAN: Cleanup saat halaman di-unload
    window.addEventListener('beforeunload', () => {
        if (window.progressChartInstance) {
            window.progressChartInstance.destroy();
        }
    });
</script>
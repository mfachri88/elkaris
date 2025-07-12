@component("layouts.admin-layout", [
    "judul" => "Kelola Tes Minat Bakat",
    "deskripsi" => "Panel admin untuk mengelola tes minat bakat"
])
<main class="container mx-auto">
    <section class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Tes Minat Bakat</h1>
        <p class="text-gray-600 mt-2">Lihat dan kelola hasil tes minat bakat pengguna</p>
    </section>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('admin.career-test.statistics') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-chart-bar"></i>
                Lihat Statistik
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <section class="bg-white rounded-xl border-4 border-gray-200 shadow-md overflow-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Tertinggi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($results as $result)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $result->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $result->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $careers = [
                                'software_developer' => 'Software Developer',
                                'data_scientist' => 'Data Scientist',
                                'network_engineer' => 'Network Engineer',
                                'ui_ux_designer' => 'UI/UX Designer',
                                'cybersecurity_analyst' => 'Cybersecurity Analyst',
                                'machine_learning_engineer' => 'Machine Learning Engineer',
                                'iot_engineer' => 'IoT Engineer',
                                'data_analyst' => 'Data Analyst',
                                'data_engineer' => 'Data Engineer',
                                'it_consultant' => 'IT Consultant',
                                'mobile_developer' => 'Mobile Developer',
                                'devops_engineer' => 'DevOps Engineer',
                                'system_engineer' => 'System Engineer',
                                'cloud_engineer' => 'Cloud Engineer'
                            ];
                            $colors = [
                                'software_developer' => 'blue',
                                'data_scientist' => 'purple',
                                'network_engineer' => 'green',
                                'ui_ux_designer' => 'pink',
                                'cybersecurity_analyst' => 'red',
                                'machine_learning_engineer' => 'indigo',
                                'iot_engineer' => 'yellow',
                                'data_analyst' => 'lime',
                                'data_engineer' => 'teal',
                                'it_consultant' => 'cyan',
                                'mobile_developer' => 'orange',
                                'devops_engineer' => 'fuchsia',
                                'system_engineer' => 'rose',
                                'cloud_engineer' => 'sky'
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $colors[$result->result] ?? 'gray' }}-100 text-{{ $colors[$result->result] ?? 'gray' }}-800">
                            {{ $careers[$result->result] ?? 'Unknown' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $maxScore = max([
                                $result->software_developer,
                                $result->data_scientist,
                                $result->network_engineer,
                                $result->ui_ux_designer,
                                $result->cybersecurity_analyst,
                                $result->machine_learning_engineer,
                                $result->iot_engineer,
                                $result->data_analyst,
                                $result->data_engineer,
                                $result->it_consultant,
                                $result->mobile_developer,
                                $result->devops_engineer,
                                $result->system_engineer,
                                $result->cloud_engineer
                            ]);
                        @endphp
                        {{ $maxScore }}%
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $result->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.career-test.show', $result->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.career-test.destroy', $result->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil tes ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada hasil tes minat bakat</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="mt-6">
        {{ $results->links() }}
    </div>
</main>
@endcomponent
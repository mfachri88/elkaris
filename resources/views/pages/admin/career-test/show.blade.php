@component("layouts.admin-layout", [
    "judul" => "Detail Hasil Tes Minat Bakat",
    "deskripsi" => "Detail hasil tes minat bakat pengguna"
])
<main class="container mx-auto">
    <section class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Detail Hasil Tes</h1>
            <a href="{{ route('admin.career-test.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
        <p class="text-gray-600 mt-2">Hasil tes minat bakat untuk {{ $result->user->name }}</p>
    </section>

    <section class="bg-white p-6 rounded-xl shadow-md mb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-700 mb-4">Informasi Pengguna</h2>
                <div class="space-y-3">
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Nama</span>
                        <span class="font-medium">{{ $result->user->name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Email</span>
                        <span class="font-medium">{{ $result->user->email }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Tanggal Tes</span>
                        <span class="font-medium">{{ $result->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-bold text-gray-700 mb-4">Hasil Utama</h2>
                <div class="p-4 rounded-lg bg-{{ $careerDescriptions[$result->result]['color'] }}-100 border border-{{ $careerDescriptions[$result->result]['color'] }}-300">
                    <h3 class="font-bold text-{{ $careerDescriptions[$result->result]['color'] }}-800 mb-1">{{ $careerDescriptions[$result->result]['title'] }}</h3>
                    <p class="text-{{ $careerDescriptions[$result->result]['color'] }}-700 text-sm">{{ $careerDescriptions[$result->result]['description'] }}</p>
                </div>
            </div>
        </div>
        
        <h2 class="text-xl font-bold text-gray-700 mb-4">Persentase Per Kategori</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <!-- Software Developer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'software_developer' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Software Developer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $result->software_developer }}%"></div>
                </div>
                <p class="text-lg font-bold text-blue-500">{{ $result->software_developer }}%</p>
            </div>
            
            <!-- Data Scientist -->
            <div class="p-4 rounded-lg border {{ $result->result == 'data_scientist' ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Data Scientist</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-purple-500 h-2.5 rounded-full" style="width: {{ $result->data_scientist }}%"></div>
                </div>
                <p class="text-lg font-bold text-purple-500">{{ $result->data_scientist }}%</p>
            </div>
            
            <!-- Network Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'network_engineer' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Network Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $result->network_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-green-500">{{ $result->network_engineer }}%</p>
            </div>
            
            <!-- UI/UX Designer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'ui_ux_designer' ? 'border-pink-500 bg-pink-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">UI/UX Designer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-pink-500 h-2.5 rounded-full" style="width: {{ $result->ui_ux_designer }}%"></div>
                </div>
                <p class="text-lg font-bold text-pink-500">{{ $result->ui_ux_designer }}%</p>
            </div>
            
            <!-- Cybersecurity Analyst -->
            <div class="p-4 rounded-lg border {{ $result->result == 'cybersecurity_analyst' ? 'border-red-500 bg-red-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Cybersecurity Analyst</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-red-500 h-2.5 rounded-full" style="width: {{ $result->cybersecurity_analyst }}%"></div>
                </div>
                <p class="text-lg font-bold text-red-500">{{ $result->cybersecurity_analyst }}%</p>
            </div>
            
            <!-- Machine Learning Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'machine_learning_engineer' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Machine Learning Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-indigo-500 h-2.5 rounded-full" style="width: {{ $result->machine_learning_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-indigo-500">{{ $result->machine_learning_engineer }}%</p>
            </div>
            
            <!-- IoT Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'iot_engineer' ? 'border-yellow-500 bg-yellow-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">IoT Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $result->iot_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-yellow-500">{{ $result->iot_engineer }}%</p>
            </div>
            
            <!-- Data Analyst -->
            <div class="p-4 rounded-lg border {{ $result->result == 'data_analyst' ? 'border-lime-500 bg-lime-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Data Analyst</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-lime-500 h-2.5 rounded-full" style="width: {{ $result->data_analyst }}%"></div>
                </div>
                <p class="text-lg font-bold text-lime-500">{{ $result->data_analyst }}%</p>
            </div>
            
            <!-- Data Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'data_engineer' ? 'border-teal-500 bg-teal-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Data Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-teal-500 h-2.5 rounded-full" style="width: {{ $result->data_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-teal-500">{{ $result->data_engineer }}%</p>
            </div>
            
            <!-- IT Consultant -->
            <div class="p-4 rounded-lg border {{ $result->result == 'it_consultant' ? 'border-cyan-500 bg-cyan-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">IT Consultant</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-cyan-500 h-2.5 rounded-full" style="width: {{ $result->it_consultant }}%"></div>
                </div>
                <p class="text-lg font-bold text-cyan-500">{{ $result->it_consultant }}%</p>
            </div>
            
            <!-- Mobile Developer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'mobile_developer' ? 'border-orange-500 bg-orange-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Mobile Developer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-orange-500 h-2.5 rounded-full" style="width: {{ $result->mobile_developer }}%"></div>
                </div>
                <p class="text-lg font-bold text-orange-500">{{ $result->mobile_developer }}%</p>
            </div>
            
            <!-- DevOps Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'devops_engineer' ? 'border-fuchsia-500 bg-fuchsia-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">DevOps Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-fuchsia-500 h-2.5 rounded-full" style="width: {{ $result->devops_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-fuchsia-500">{{ $result->devops_engineer }}%</p>
            </div>
            
            <!-- System Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'system_engineer' ? 'border-rose-500 bg-rose-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">System Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-rose-500 h-2.5 rounded-full" style="width: {{ $result->system_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-rose-500">{{ $result->system_engineer }}%</p>
            </div>
            
            <!-- Cloud Engineer -->
            <div class="p-4 rounded-lg border {{ $result->result == 'cloud_engineer' ? 'border-sky-500 bg-sky-50' : 'border-gray-200' }}">
                <h3 class="font-medium text-gray-800 mb-2">Cloud Engineer</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-sky-500 h-2.5 rounded-full" style="width: {{ $result->cloud_engineer }}%"></div>
                </div>
                <p class="text-lg font-bold text-sky-500">{{ $result->cloud_engineer }}%</p>
            </div>
        </div>
        
        <div class="flex justify-end space-x-2">
            <form action="{{ route('admin.career-test.destroy', $result->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil tes ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash mr-1"></i> Hapus Hasil
                </button>
            </form>
        </div>
    </section>
</main>
@endcomponent
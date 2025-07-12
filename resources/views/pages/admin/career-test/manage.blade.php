@component("layouts.admin-layout", [
    "judul" => "Kelola Pertanyaan Tes Minat Bakat",
    "deskripsi" => "Panel admin untuk mengelola pertanyaan tes minat bakat"
])
<main class="container mx-auto">
    <section class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Pertanyaan Tes Minat Bakat</h1>
            <div class="flex space-x-2">
                <button onclick="openAddModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-plus"></i>
                    Tambah Pertanyaan
                </button>
                <a href="{{ route('admin.career-test.manage.seed') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" onclick="return confirm('Apakah Anda yakin ingin menambahkan pertanyaan default? Ini hanya akan berfungsi jika database kosong.')">
                    <i class="fas fa-seedling"></i>
                    Tambah Pertanyaan Default
                </a>
                <a href="{{ route('admin.career-test.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-list"></i>
                    Hasil Tes
                </a>
            </div>
        </div>
        <p class="text-gray-600 mt-2">Tambah, edit, atau hapus pertanyaan untuk tes minat bakat</p>
    </section>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
        <p>{{ session('info') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div id="message-container" class="mb-6 hidden">
        <div id="success-message" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 hidden" role="alert">
            <p id="success-message-text"></p>
        </div>
        <div id="error-message" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 hidden" role="alert">
            <p id="error-message-text"></p>
        </div>
    </div>

    <section class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Karir</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($questions as $question)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $question->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $question->text }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @php
                                $categoryName = $categories[$question->category] ?? $question->category;
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
                                $color = $colors[$question->category] ?? 'gray';
                            @endphp
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                {{ $categoryName }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button onclick="editQuestion({{ $question->id }})" class="text-blue-500 hover:text-blue-700 mx-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteQuestion({{ $question->id }})" class="text-red-500 hover:text-red-700 mx-1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada pertanyaan yang tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="mt-6">
        {{ $questions->links() }}
    </div>
</main>

<!-- Add Question Modal -->
<div id="add_question_modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 bg-white rounded-xl shadow-lg max-w-xl w-full">
        <div class="px-6 py-4 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Pertanyaan Baru</h3>
        </div>
        <form id="add_question_form" action="{{ route('admin.career-test.manage.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-6">
                <div class="mb-4">
                    <label for="text" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                    <textarea id="text" name="text" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    <p id="text-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori Karir</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <p id="category-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
            </div>
            <div class="px-6 py-4 border-t flex justify-end space-x-4">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Question Modal -->
<div id="edit_question_modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 bg-white rounded-xl shadow-lg max-w-xl w-full">
        <div class="px-6 py-4 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Edit Pertanyaan</h3>
        </div>
        <form id="edit_question_form" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div class="mb-4">
                    <label for="edit_text" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                    <textarea id="edit_text" name="text" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    <p id="edit-text-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
                <div class="mb-4">
                    <label for="edit_category" class="block text-sm font-medium text-gray-700 mb-1">Kategori Karir</label>
                    <select id="edit_category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <p id="edit-category-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
            </div>
            <div class="px-6 py-4 border-t flex justify-end space-x-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showMessage(type, message) {
        const messageContainer = document.getElementById('message-container');
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        const successText = document.getElementById('success-message-text');
        const errorText = document.getElementById('error-message-text');
        
        messageContainer.classList.remove('hidden');
        
        if (type === 'success') {
            successMessage.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            successText.textContent = message;
        } else {
            successMessage.classList.add('hidden');
            errorMessage.classList.remove('hidden');
            errorText.textContent = message;
        }
        
        // Hide the message after 5 seconds
        setTimeout(() => {
            messageContainer.classList.add('hidden');
        }, 5000);
    }
    
    function openAddModal() {
        document.getElementById('add_question_modal').classList.remove('hidden');
        document.getElementById('add_question_form').reset();
        
        // Clear validation errors
        document.getElementById('text-error').classList.add('hidden');
        document.getElementById('category-error').classList.add('hidden');
    }
    
    function closeAddModal() {
        document.getElementById('add_question_modal').classList.add('hidden');
    }
    
    function openEditModal() {
        document.getElementById('edit_question_modal').classList.remove('hidden');
    }
    
    function closeEditModal() {
        document.getElementById('edit_question_modal').classList.add('hidden');
    }
    
    function editQuestion(id) {
        fetch(`{{ route('admin.career-test.manage.get', '') }}/${id}`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('edit_question_form');
                form.action = `{{ route('admin.career-test.manage.update', '') }}/${id}`;
                
                document.getElementById('edit_text').value = data.text;
                document.getElementById('edit_category').value = data.category;
                
                openEditModal();
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', 'Terjadi kesalahan saat mengambil data pertanyaan');
            });
    }
    
    function deleteQuestion(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`{{ route('admin.career-test.manage.destroy', '') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('success', data.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showMessage('error', data.error || 'Terjadi kesalahan saat menghapus pertanyaan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', 'Terjadi kesalahan saat menghapus pertanyaan');
            });
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Add Question Form Submission
        const addForm = document.getElementById('add_question_form');
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeAddModal();
                    showMessage('success', data.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else if (data.errors) {
                    // Show validation errors
                    if (data.errors.text) {
                        document.getElementById('text-error').textContent = data.errors.text[0];
                        document.getElementById('text-error').classList.remove('hidden');
                    }
                    if (data.errors.category) {
                        document.getElementById('category-error').textContent = data.errors.category[0];
                        document.getElementById('category-error').classList.remove('hidden');
                    }
                } else if (data.error) {
                    showMessage('error', data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', 'Terjadi kesalahan saat menyimpan pertanyaan');
            });
        });
        
        // Edit Question Form Submission
        const editForm = document.getElementById('edit_question_form');
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeEditModal();
                    showMessage('success', data.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else if (data.errors) {
                    // Show validation errors
                    if (data.errors.text) {
                        document.getElementById('edit-text-error').textContent = data.errors.text[0];
                        document.getElementById('edit-text-error').classList.remove('hidden');
                    }
                    if (data.errors.category) {
                        document.getElementById('edit-category-error').textContent = data.errors.category[0];
                        document.getElementById('edit-category-error').classList.remove('hidden');
                    }
                } else if (data.error) {
                    showMessage('error', data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', 'Terjadi kesalahan saat memperbarui pertanyaan');
            });
        });
    });
</script>
@endcomponent

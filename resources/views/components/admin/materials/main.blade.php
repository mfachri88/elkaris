
<section class="mb-8 flex flex-col items-start justify-between gap-y-4 lg:flex-row lg:items-center">
    <h2 class="font-bold text-3xl text-gray-800">Kelola Materi</h2>
    <button
        onclick="open_modal('add_material_modal')"
        class="flex items-center gap-3 px-6 py-3 transition-colors rounded-xl bg-blue-500 text-white hover:bg-blue-600"
    >
        <i class="fas fa-plus"></i>
        <h5>Tambah Materi</h5>
    </button>
</section>

<div id="status-message" class="hidden mb-6 p-4 rounded-lg border bg-green-100 border-green-400 text-green-700"></div>

@if(session('success'))
    <h4 class="mb-6 p-4 rounded-lg border bg-green-100 border-green-400 text-green-700">
        {{ session('success') }}
    </h4>
@endif
<section class="mb-6">
    <form action="{{ route('admin.materials.index') }}" method="GET" class="flex items-center gap-4">
        <input type="text" name="search" placeholder="Cari materi..." value="{{ request('search') }}"
            class="px-4 py-2 border rounded-md">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            Cari
        </button>
    </form>
</section>
<section class="text-center rounded-xl border-4 border-gray-200 shadow-md overflow-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4">ID</th>
                <th class="px-6 py-4">Judul</th>
                <th class="px-6 py-4">Tingkat Kesulitan</th>
                <th class="px-6 py-4">Warna</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($materials as $material)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $material->id }}
                    </td>
                    <td class="px-6 py-4">{{ $material->title }}</td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-sm
                            @if($material->difficulty_level === 'mudah')
                                bg-green-100 text-green-700
                            @elseif($material->difficulty_level === 'sedang')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst($material->difficulty_level) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-sm
                           @switch($material->color)
                               @case('blue')
                                   bg-blue-100 text-blue-700
                                   @break
                               @case('green')
                                   bg-green-100 text-green-700
                                   @break
                               @case('yellow')
                                   bg-yellow-100 text-yellow-700
                                   @break
                               @case('red')
                                   bg-red-100 text-red-700
                                   @break
                               @case('purple')
                                   bg-purple-100 text-purple-700
                                   @break
                               @case('orange')
                                   bg-orange-100 text-orange-700
                                   @break
                               @case('pink')
                                   bg-pink-100 text-pink-700
                                   @break
                               @case('gray')
                                   bg-gray-100 text-gray-700
                                   @break
                               @case('violet')
                                   bg-violet-100 text-violet-700
                                   @break
                               @case('indigo')
                                   bg-indigo-100 text-indigo-700
                                   @break
                               @case('amber')
                                   bg-amber-100 text-amber-700
                                   @break
                               @case('emerald')
                                   bg-emerald-100 text-emerald-700
                                   @break
                               @case('teal')
                                   bg-teal-100 text-teal-700
                                   @break
                               @case('cyan')
                                   bg-cyan-100 text-cyan-700
                                   @break
                               @case('sky')
                                   bg-sky-100 text-sky-700
                                   @break
                               @case('lime')
                                   bg-lime-100 text-lime-700
                                   @break
                               @case('fuchsia')
                                   bg-fuchsia-100 text-fuchsia-700
                                   @break
                           @endswitch
                        ">
                            {{ ucfirst($material->color) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a
                            onclick="toggleStatus('{{ $material->id }}')"
                            class="cursor-pointer rounded-full px-3 py-1 text-sm {{ $material->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $material->is_active ? 'Aktif' : 'Nonaktif' }}
                        </a>
                    </td>
                    <td>
                        <span class="flex items-center justify-center gap-6">
                            <button
                                data-material-id="{{ $material->id }}"
                                class="edit-material-btn fas fa-edit text-blue-500 hover:text-blue-600"
                            ></button>
                            <form
                                action="{{ route('admin.materials.destroy', $material) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')"
                                class="inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-trash text-red-500 hover:text-red-600"></button>
                            </form>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<section class="mt-6">
    {{ $materials->links() }}
</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set up click listeners for all edit buttons
        const editButtons = document.querySelectorAll('.edit-material-btn');
        
        if (editButtons.length === 0) {
            console.warn('No edit material buttons found on page');
        }
        
        editButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                
                const materialId = this.getAttribute('data-material-id');
                if (!materialId) {
                    console.error('Material ID not found on edit button');
                    showErrorMessage('Error: Material ID not found');
                    return;
                }
                
                // Validate material ID is numeric
                if (!/^\d+$/.test(materialId)) {
                    console.error('Invalid material ID format:', materialId);
                    showErrorMessage('Error: Invalid material ID format');
                    return;
                }
                
                fetchMaterialData(materialId);
            });
        });
        
        // Verify CSRF token is available
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token meta tag not found in page head');
        }
    });

    function fetchMaterialData(materialId) {
        // Get CSRF token with null checking
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found in page meta tags');
            showErrorMessage('Error: CSRF token not found. Please refresh the page.');
            return;
        }
        
        const token = csrfToken.getAttribute('content');
        if (!token) {
            console.error('CSRF token content is empty');
            showErrorMessage('Error: Invalid CSRF token. Please refresh the page.');
            return;
        }
        
        // Show loading state
        const statusMessage = document.getElementById('status-message');
        if (statusMessage) {
            statusMessage.textContent = 'Sedang memuat data materi...';
            statusMessage.classList.remove('hidden', 'bg-red-100', 'border-red-400', 'text-red-700');
            statusMessage.classList.add('bg-blue-100', 'border-blue-400', 'text-blue-700');
            statusMessage.classList.remove('hidden');
        }
        
        // Fetch material data via AJAX
        fetch(`/admin/materials/${materialId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Hide status message
            if (statusMessage) {
                statusMessage.classList.add('hidden');
            }
            
            // Validate data structure
            if (!data || typeof data !== 'object') {
                throw new Error('Invalid data received from server');
            }
            
            // Handle the material data
            populateEditForm(data);
            
            // Open the modal
            open_modal('edit_material_modal');
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorMessage(`Terjadi kesalahan saat mengambil data materi: ${error.message}`);
        });
    }

    // Helper function to show error messages
    function showErrorMessage(message) {
        const statusMessage = document.getElementById('status-message');
        if (statusMessage) {
            statusMessage.textContent = message;
            statusMessage.classList.remove('bg-blue-100', 'border-blue-400', 'text-blue-700', 'bg-green-100', 'border-green-400', 'text-green-700');
            statusMessage.classList.add('bg-red-100', 'border-red-400', 'text-red-700');
            statusMessage.classList.remove('hidden');
            
            setTimeout(() => {
                statusMessage.classList.add('hidden');
            }, 5000);
        }
    }

    function populateEditForm(material) {
        const form = document.getElementById('edit_material_form');
        if (!form) {
            console.error('Edit form not found');
            return;
        }
        
        form.action = `/admin/materials/${material.id}`;

        // Set basic material info with null checking
        const titleField = document.getElementById('edit_title');
        const descField = document.getElementById('edit_description');
        const difficultyField = document.getElementById('edit_difficulty_level');
        const colorField = document.getElementById('edit_color');
        
        if (titleField) titleField.value = material.title || '';
        if (descField) descField.value = material.description || '';
        if (difficultyField) difficultyField.value = material.difficulty_level || '';
        if (colorField) colorField.value = material.color || '';
        
        // Reset content fields to avoid old data persisting
        resetContentFields();
        
        // Set content fields if contents exist
        if (material.contents && material.contents.length > 0) {
            material.contents.forEach(content => {
                const sectionType = content.section_type;
                if (!sectionType) return;
                
                switch (sectionType) {
                    case 'pengenalan':
                        const introIdField = document.getElementById('edit_introduction_id');
                        const introTitleField = document.getElementById('edit_introduction_title');
                        const introContentField = document.getElementById('edit_introduction_content');
                        const introAudioField = document.getElementById('edit_introduction_audio');
                        
                        if (introIdField) introIdField.value = content.id || '';
                        if (introTitleField) introTitleField.value = content.title || '';
                        if (introContentField) introContentField.value = content.content || '';
                        if (introAudioField) introAudioField.value = content.audio_text || '';
                        
                        // Handle Quill editor for introduction
                        if (window.quillEditors && window.quillEditors.editIntroduction) {
                            window.quillEditors.editIntroduction.root.innerHTML = content.content || '';
                        }
                        
                        // Set image preview if it exists
                        if (content.image_path) {
                            const preview = document.getElementById('edit_introduction_image_preview');
                            if (preview) {
                                preview.src = `/storage/${content.image_path}`;
                                preview.classList.remove('hidden');
                                
                                const deleteBtn = document.getElementById('edit_introduction_delete_button');
                                if (deleteBtn) {
                                    deleteBtn.classList.remove('hidden');
                                }
                            }
                        }
                        break;
                        
                    case 'materi_utama':
                        const mainIdField = document.getElementById('edit_main_id');
                        const mainTitleField = document.getElementById('edit_main_title');
                        const mainContentField = document.getElementById('edit_main_content');
                        const mainAudioField = document.getElementById('edit_main_audio');
                        
                        if (mainIdField) mainIdField.value = content.id || '';
                        if (mainTitleField) mainTitleField.value = content.title || '';
                        if (mainContentField) mainContentField.value = content.content || '';
                        if (mainAudioField) mainAudioField.value = content.audio_text || '';
                        
                        // Handle Quill editor for main content
                        if (window.quillEditors && window.quillEditors.editMain) {
                            window.quillEditors.editMain.root.innerHTML = content.content || '';
                        }
                        
                        // Set image preview if it exists
                        if (content.image_path) {
                            const preview = document.getElementById('edit_main_image_preview');
                            if (preview) {
                                preview.src = `/storage/${content.image_path}`;
                                preview.classList.remove('hidden');
                                
                                const deleteBtn = document.getElementById('edit_main_delete_button');
                                if (deleteBtn) {
                                    deleteBtn.classList.remove('hidden');
                                }
                            }
                        }
                        break;
                        
                    case 'latihan':
                        const exerciseIdField = document.getElementById('edit_exercise_id');
                        const exerciseTitleField = document.getElementById('edit_exercise_title');
                        const exerciseContentField = document.getElementById('edit_exercise_content');
                        const exerciseAudioField = document.getElementById('edit_exercise_audio');
                        
                        if (exerciseIdField) exerciseIdField.value = content.id || '';
                        if (exerciseTitleField) exerciseTitleField.value = content.title || '';
                        if (exerciseContentField) exerciseContentField.value = content.content || '';
                        if (exerciseAudioField) exerciseAudioField.value = content.audio_text || '';
                        
                        // Handle Quill editor for exercise
                        if (window.quillEditors && window.quillEditors.editExercise) {
                            window.quillEditors.editExercise.root.innerHTML = content.content || '';
                        }
                        
                        // Set image preview if it exists
                        if (content.image_path) {
                            const preview = document.getElementById('edit_exercise_image_preview');
                            if (preview) {
                                preview.src = `/storage/${content.image_path}`;
                                preview.classList.remove('hidden');
                                
                                const deleteBtn = document.getElementById('edit_exercise_delete_button');
                                if (deleteBtn) {
                                    deleteBtn.classList.remove('hidden');
                                }
                            }
                        }
                        break;
                }
            });
        }
    }

    function resetContentFields() {
        // Reset introduction fields with null checking
        const introIdField = document.getElementById('edit_introduction_id');
        const introTitleField = document.getElementById('edit_introduction_title');
        const introContentField = document.getElementById('edit_introduction_content');
        const introAudioField = document.getElementById('edit_introduction_audio');
        
        if (introIdField) introIdField.value = '';
        if (introTitleField) introTitleField.value = '';
        if (introContentField) introContentField.value = '';
        if (introAudioField) introAudioField.value = '';
        
        // Reset main content fields with null checking
        const mainIdField = document.getElementById('edit_main_id');
        const mainTitleField = document.getElementById('edit_main_title');
        const mainContentField = document.getElementById('edit_main_content');
        const mainAudioField = document.getElementById('edit_main_audio');
        
        if (mainIdField) mainIdField.value = '';
        if (mainTitleField) mainTitleField.value = '';
        if (mainContentField) mainContentField.value = '';
        if (mainAudioField) mainAudioField.value = '';
        
        // Reset exercise fields with null checking
        const exerciseIdField = document.getElementById('edit_exercise_id');
        const exerciseTitleField = document.getElementById('edit_exercise_title');
        const exerciseContentField = document.getElementById('edit_exercise_content');
        const exerciseAudioField = document.getElementById('edit_exercise_audio');
        
        if (exerciseIdField) exerciseIdField.value = '';
        if (exerciseTitleField) exerciseTitleField.value = '';
        if (exerciseContentField) exerciseContentField.value = '';
        if (exerciseAudioField) exerciseAudioField.value = '';
        
        // Reset quill editors if they exist
        if (window.quillEditors) {
            if (window.quillEditors.editIntroduction) {
                window.quillEditors.editIntroduction.root.innerHTML = '';
            }
            if (window.quillEditors.editMain) {
                window.quillEditors.editMain.root.innerHTML = '';
            }
            if (window.quillEditors.editExercise) {
                window.quillEditors.editExercise.root.innerHTML = '';
            }
        }
        
        // Reset image previews
        const previews = document.querySelectorAll('[id$="_image_preview"]');
        previews.forEach(preview => {
            if (preview) {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
        
        // Reset delete buttons
        const deleteButtons = document.querySelectorAll('[id$="_delete_button"]');
        deleteButtons.forEach(button => {
            if (button) {
                button.classList.add('hidden');
            }
        });
    }

    function open_modal(id_modal) {
        const modal = document.getElementById(id_modal);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            console.error(`Modal with id ${id_modal} not found`);
            showErrorMessage(`Error: Modal ${id_modal} not found`);
        }
    }

    function close_modal(id_modal) {
        const modal = document.getElementById(id_modal);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        } else {
            console.error(`Modal with id ${id_modal} not found`);
        }
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed')) {
            const modals = document.querySelectorAll('.fixed.inset-0.z-50');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    close_modal(modal.id);
                }
            });
        }
    });

    function toggleStatus(id) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/materials/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const statusMessage = document.getElementById('status-message');
                statusMessage.textContent = data.message;
                statusMessage.classList.remove('hidden', 'bg-red-100', 'border-red-400', 'text-red-700');
                statusMessage.classList.add('bg-green-100', 'border-green-400', 'text-green-700');
                statusMessage.classList.remove('hidden');

                setTimeout(() => {
                    statusMessage.classList.add('hidden');
                }, 2000);

                const statusElement = document.querySelector(`a[onclick="toggleStatus('${id}')"]`);
                if (statusElement) {
                    statusElement.textContent = data.status ? 'Aktif' : 'Nonaktif';
                    statusElement.classList.remove('bg-gray-100', 'text-gray-700', 'bg-green-100', 'text-green-700');
                    if (data.status) {
                        statusElement.classList.add('bg-green-100');
                        statusElement.classList.add('text-green-700');
                    } else {
                        statusElement.classList.add('bg-gray-100');
                        statusElement.classList.add('text-gray-700');
                    }
                }
            } else {
                const statusMessage = document.getElementById('status-message');
                statusMessage.textContent = data.message;
                statusMessage.classList.remove('hidden', 'bg-green-100', 'border-green-400', 'text-green-700');
                statusMessage.classList.add('bg-red-100', 'border-red-400', 'text-red-700');
                statusMessage.classList.remove('hidden');

                setTimeout(() => {
                    statusMessage.classList.add('hidden');
                }, 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const statusMessage = document.getElementById('status-message');
            statusMessage.textContent = 'Terjadi kesalahan saat mengubah status materi';
            statusMessage.classList.remove('hidden', 'bg-green-100', 'border-green-400', 'text-green-700');
            statusMessage.classList.add('bg-red-100', 'border-red-400', 'text-red-700');
            statusMessage.classList.remove('hidden');

            setTimeout(() => {
                statusMessage.classList.add('hidden');
            }, 2000);
        });
    }
</script>
@include('components.admin.materials.edit-modal')
@include('components.admin.materials.add-modal')
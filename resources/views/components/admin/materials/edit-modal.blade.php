
@component('components.admin.materials.modal', ['id' => 'add_material_modal', 'title' => 'Tambah Materi'])
<form action="{{ route('admin.materials.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="add_material_form">
    @csrf

    <div>
        <label for="add_title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" id="add_title" required
            class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200">
    </div>

    <div>
        <label for="add_description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="add_description" rows="3" required
            class="mt-1 block resize-none w-full rounded-xl border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <fieldset>
            <label for="add_difficulty_level" class="block text-sm font-medium text-gray-700">Tingkat Kesulitan</label>
            <select name="difficulty_level" id="add_difficulty_level" required
                class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200">
                <option value="mudah">Mudah</option>
                <option value="sedang">Sedang</option>
                <option value="sulit">Sulit</option>
            </select>
        </fieldset>
        <fieldset>
            <label for="edit_color" class="block text-sm font-medium text-gray-700">
                Warna
            </label>
            <select name="color" id="edit_color" required
                class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200">
                <option value="blue">Biru</option>
                <option value="green">Hijau</option>
                <option value="yellow">Kuning</option>
                <option value="red">Merah</option>
                <option value="purple">Ungu</option>
                <option value="orange">Orange</option>
                <option value="pink">Pink</option>
                <option value="gray">Abu-abu</option>
                <option value="violet">Violet</option>
                <option value="indigo">Indigo</option>
                <option value="amber">Amber</option>
                <option value="emerald">Emerald</option>
                <option value="teal">Teal</option>
                <option value="cyan">Cyan</option>
                <option value="sky">Sky</option>
                <option value="lime">Lime</option>
                <option value="fuchsia">Fuchsia</option>
            </select>
        </fieldset>
    </div>

    <div class="space-y-4">
        <h4 class="font-medium text-gray-700">Konten Materi</h4>

        <!-- Pengenalan Section -->
        <div class="rounded-xl border-2 border-gray-200 p-4">
            <h5 class="mb-4 font-medium text-gray-600">Pengenalan</h5>
            <input type="hidden" name="contents[0][section_type]" value="pengenalan">
            <input type="hidden" name="contents[0][id]" id="add_introduction_id">
            <div class="space-y-4">
                <fieldset>
                    <label class="block text-sm text-gray-600">Judul</label>
                    <input type="text" name="contents[0][title]" id="add_introduction_title" required
                        class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3" />
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Konten</label>
                    <div id="add_introduction_editor" data-name="contents[0][content]" class="h-64 mb-4"></div>
                    <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Gambar</label>
                    <input type="file" name="contents[0][image]" id="add_introduction_image" accept="image/*"
                        class="mt-1 block w-full">
                    <img id="add_introduction_image_preview" src="#" alt="Preview Gambar" class="mt-2 max-h-40 hidden">
                </fieldset>
            </div>
        </div>

        <!-- Materi Utama Section -->
        <div class="rounded-xl border-2 border-gray-200 p-4">
            <div class="flex items-center justify-between mb-4">
                <h5 class="font-medium text-gray-600">Materi Utama</h5>
                <button type="button" onclick="addMainContent()"
                    class="rounded-xl bg-blue-100 px-4 py-2 text-blue-600 hover:bg-blue-200">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Materi Utama
                </button>
            </div>
            
            <div id="main-contents-container" class="space-y-6">
                <div class="p-4 border-2 border-gray-200 rounded-xl space-y-4 main-content-item">
                    <input type="hidden" name="contents[1][section_type]" value="materi_utama">
                    <input type="hidden" name="contents[1][id]" class="main-content-id">
                    <div class="space-y-4">
                        <fieldset>
                            <label class="block text-sm text-gray-600">Judul</label>
                            <input type="text" name="contents[1][title]" required
                                class="main-content-title mt-1 block w-full rounded-xl border-2 border-gray-200 p-3">
                        </fieldset>
                        <fieldset>
                            <label class="block text-sm text-gray-600">Konten</label>
                            <div id="add_main_editor" data-name="contents[1][content]" class="main-content-editor h-64 mb-4"></div>
                            <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                        </fieldset>
                        <fieldset>
                            <label class="block text-sm text-gray-600">Gambar</label>
                            <input type="file" name="contents[1][image]" accept="image/*"
                                class="main-content-image mt-1 block w-full" onchange="previewContentImage(this)">
                            <img src="#" alt="Preview Gambar" class="main-content-image-preview mt-2 max-h-40 hidden">
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <div class="flex justify-end gap-4">
        <button type="button" onclick="close_modal('add_material_modal')"
            class="rounded-xl bg-gray-100 px-6 py-3 text-gray-700 hover:bg-gray-200">
            Batal
        </button>
        <button type="submit" class="rounded-xl bg-blue-500 px-6 py-3 text-white hover:bg-blue-600">
            Tambah Materi
        </button>
    </div>
</form>
@endcomponent

<script>
    // Variable to track the count of main content sections
    let mainContentCount = 1;

    function addMainContent() {
        mainContentCount++;
        const container = document.getElementById('main-contents-container');
        const contentDiv = document.createElement('div');
        contentDiv.className = 'p-4 border-2 border-gray-200 rounded-xl space-y-4 main-content-item';
        
        contentDiv.innerHTML = `
            <div class="flex items-center justify-between mb-2">
                <h6 class="font-medium">Materi ${mainContentCount}</h6>
                <button type="button" onclick="removeMainContent(this)"
                    class="text-red-500 hover:text-red-600">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <input type="hidden" name="contents[${mainContentCount + 1}][section_type]" value="materi_utama">
            <input type="hidden" name="contents[${mainContentCount + 1}][id]" class="main-content-id">
            <div class="space-y-4">
                <fieldset>
                    <label class="block text-sm text-gray-600">Judul</label>
                    <input type="text" name="contents[${mainContentCount + 1}][title]" required
                        class="main-content-title mt-1 block w-full rounded-xl border-2 border-gray-200 p-3">
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Konten</label>
                    <div class="main-content-editor h-64 mb-4" data-name="contents[${mainContentCount + 1}][content]"></div>
                    <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Gambar</label>
                    <input type="file" name="contents[${mainContentCount + 1}][image]" accept="image/*"
                        class="main-content-image mt-1 block w-full" onchange="previewContentImage(this)">
                    <img src="#" alt="Preview Gambar" class="main-content-image-preview mt-2 max-h-40 hidden">
                </fieldset>
            </div>
        `;
        
        container.appendChild(contentDiv);
        
        // Initialize editor for the new content
        const editorElement = contentDiv.querySelector('.main-content-editor');
        initQuill(editorElement);
    }
    
    function removeMainContent(button) {
        const contentItem = button.closest('.main-content-item');
        if (contentItem) {
            contentItem.remove();
        }
    }

    function previewContentImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const preview = input.parentElement.querySelector('.main-content-image-preview');
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showImagePreview(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('add_introduction_image').addEventListener('change', function () {
        showImagePreview(this, 'add_introduction_image_preview');
    });

    

    document.addEventListener('DOMContentLoaded', function() {
        const addForm = document.getElementById('add_material_form');
        if (addForm) {
            addForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Process the Quill editors content for standard sections
                const introEditor = document.querySelector('#add_introduction_editor').querySelector('.ql-editor');
                const exerciseEditor = document.querySelector('#add_exercise_editor').querySelector('.ql-editor');
                
                // Create hidden inputs for standard editor content
                const introInput = document.createElement('input');
                introInput.type = 'hidden';
                introInput.name = 'contents[0][content]';
                introInput.value = introEditor.innerHTML;
                
                const exerciseInput = document.createElement('input');
                exerciseInput.type = 'hidden';
                exerciseInput.name = 'contents[2][content]';
                exerciseInput.value = exerciseEditor.innerHTML;
                
                // Add to form
                addForm.appendChild(introInput);
                addForm.appendChild(exerciseInput);
                
                // Process all main content sections
                const mainContentItems = document.querySelectorAll('.main-content-item');
                
                mainContentItems.forEach((item, index) => {
                    // Get the content index from the hidden input
                    const sectionTypeInput = item.querySelector('input[name*="[section_type]"]');
                    if (!sectionTypeInput) return;
                    
                    const nameMatch = sectionTypeInput.name.match(/contents\[(\d+)\]/);
                    if (!nameMatch) return;
                    
                    const contentIndex = nameMatch[1];
                    
                    // Process editor content
                    const editor = item.querySelector('.main-content-editor');
                    if (editor) {
                        const editorContent = editor.querySelector('.ql-editor').innerHTML;
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = `contents[${contentIndex}][content]`;
                        hiddenInput.value = editorContent;
                        addForm.appendChild(hiddenInput);
                    }
                    
                    // Add audio text field if needed
                    const audioInput = document.createElement('input');
                    audioInput.type = 'hidden';
                    audioInput.name = `contents[${contentIndex}][audio_text]`;
                    audioInput.value = '';
                    addForm.appendChild(audioInput);
                });
                
                // Add audio text for introduction and exercise if they don't exist
                if (!addForm.querySelector('input[name="contents[0][audio_text]"]')) {
                    const introAudio = document.createElement('input');
                    introAudio.type = 'hidden';
                    introAudio.name = 'contents[0][audio_text]';
                    introAudio.value = '';
                    addForm.appendChild(introAudio);
                }
                
                if (!addForm.querySelector('input[name="contents[2][audio_text]"]')) {
                    const exerciseAudio = document.createElement('input');
                    exerciseAudio.type = 'hidden';
                    exerciseAudio.name = 'contents[2][audio_text]';
                    exerciseAudio.value = '';
                    addForm.appendChild(exerciseAudio);
                }
                
                // Submit the form
                addForm.submit();
            });
        }
    });
</script>
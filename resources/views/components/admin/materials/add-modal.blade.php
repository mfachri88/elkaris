
@component('components.admin.materials.modal', ['id' => 'edit_material_modal', 'title' => 'Edit Materi'])
<form id="edit_material_form" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="edit_title" class="block text-sm font-medium text-gray-700">
            Judul
        </label>
        <input type="text" name="title" id="edit_title" required
            class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200" />
    </fieldset>

    <fieldset>
        <label for="edit_description" class="block text-sm font-medium text-gray-700">
            Deskripsi
        </label>
        <textarea name="description" id="edit_description" rows="3" required
            class="mt-1 block w-full rounded-xl resize-none border-2 border-gray-200 p-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-200"></textarea>
    </fieldset>

    <div class="grid grid-cols-2 gap-4">
        <fieldset>
            <label for="edit_difficulty_level" class="block text-sm font-medium text-gray-700">
                Tingkat Kesulitan
            </label>
            <select name="difficulty_level" id="edit_difficulty_level" required
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
            <input type="hidden" name="contents[0][id]" id="edit_introduction_id">
            <div class="space-y-4">
                <fieldset>
                    <label class="block text-sm text-gray-600">Judul</label>
                    <input type="text" name="contents[0][title]" id="edit_introduction_title" required
                        class="mt-1 block w-full rounded-xl border-2 border-gray-200 p-3" />
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Konten</label>
                    <div id="edit_introduction_editor" data-name="contents[0][content]" class="h-64 mb-4"></div>
                    <textarea name="contents[0][content]" id="edit_introduction_content" class="hidden"></textarea>
                    <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                </fieldset>
                
                <fieldset>
                    <label class="block text-sm text-gray-600">Gambar</label>
                    <div class="image-preview-container">
                        <input type="file" name="contents[0][image]" id="edit_introduction_image" accept="image/*"
                            class="mt-1 block w-full">
                        <div class="relative mt-2">
                            <img id="edit_introduction_image_preview" src="#" alt="Preview Gambar" 
                                class="hidden max-h-40 rounded-lg">
                            <button type="button" id="edit_introduction_delete_button"
                                onclick="deleteImage('introduction')"
                                class="delete-image absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 hidden">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="rounded-xl border-2 border-gray-200 p-4">
            <div class="flex items-center justify-between mb-4">
                <h5 class="font-medium text-gray-600">Materi Utama</h5>
                <button type="button" onclick="addEditMainContent()"
                    class="rounded-xl bg-blue-100 px-4 py-2 text-blue-600 hover:bg-blue-200">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Materi Utama
                </button>
            </div>
            
            <div id="edit-main-contents-container" class="space-y-6">
                <!-- Dynamic content will be loaded here by JavaScript -->
            </div>
        </div>


        
    </div>

    <footer class="flex justify-end gap-4">
        <button type="button" onclick="close_modal('edit_material_modal')"
            class="rounded-xl bg-gray-100 px-6 py-3 text-gray-700 hover:bg-gray-200">
            Batal
        </button>
        <button type="submit" class="rounded-xl bg-blue-500 px-6 py-3 text-white hover:bg-blue-600">
            Simpan Perubahan
        </button>
    </footer>
</form>
@endcomponent

<script>
    // Variable for tracking the index of materi utama content
    let editMainContentCount = 0;
    let materialContents = [];
    
    // Function to set up the edit form with material data
    function setupEditForm(material) {
        document.getElementById('edit_title').value = material.title;
        document.getElementById('edit_description').value = material.description;
        document.getElementById('edit_difficulty_level').value = material.difficulty_level;
        document.getElementById('edit_color').value = material.color;
        
        // Store all content for later reference
        materialContents = material.contents;
        
        // Set up introduction section
        const introContent = materialContents.find(c => c.section_type === 'pengenalan');
        if (introContent) {
            document.getElementById('edit_introduction_id').value = introContent.id;
            document.getElementById('edit_introduction_title').value = introContent.title;
            
            // Set up Quill editor content
            const introEditor = Quill.find(document.getElementById('edit_introduction_editor'));
            if (introEditor) {
                introEditor.root.innerHTML = introContent.content;
            }
            
            // Set up image preview if exists
            if (introContent.image_path) {
                const imgPreview = document.getElementById('edit_introduction_image_preview');
                imgPreview.src = `/storage/${introContent.image_path}`;
                imgPreview.classList.remove('hidden');
                document.getElementById('edit_introduction_delete_button').classList.remove('hidden');
            }
        }
        
        // Set up exercise section
        
        
        // Set up main content sections (could be multiple)
        const mainContents = materialContents.filter(c => c.section_type === 'materi_utama');
        const mainContainer = document.getElementById('edit-main-contents-container');
        
        // Clear previous content
        mainContainer.innerHTML = '';
        editMainContentCount = 0;
        
        mainContents.forEach((content, index) => {
            editMainContentCount++;
            const contentDiv = document.createElement('div');
            contentDiv.className = 'p-4 border-2 border-gray-200 rounded-xl space-y-4 edit-main-content-item';
            contentDiv.dataset.contentId = content.id;
            
            contentDiv.innerHTML = `
                <div class="flex items-center justify-between mb-2">
                    <h6 class="font-medium">Materi Utama ${index + 1}</h6>
                    ${index > 0 ? `
                        <button type="button" onclick="removeEditMainContent(this, ${content.id})"
                            class="text-red-500 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    ` : ''}
                </div>
                <input type="hidden" name="contents[${index + 3}][section_type]" value="materi_utama">
                <input type="hidden" name="contents[${index + 3}][id]" value="${content.id}" class="edit-main-content-id">
                <div class="space-y-4">
                    <fieldset>
                        <label class="block text-sm text-gray-600">Judul</label>
                        <input type="text" name="contents[${index + 3}][title]" value="${content.title}" required
                            class="edit-main-content-title mt-1 block w-full rounded-xl border-2 border-gray-200 p-3">
                    </fieldset>
                    <fieldset>
                        <label class="block text-sm text-gray-600">Konten</label>
                        <div class="edit-main-content-editor h-64 mb-4" data-content-id="${content.id}" data-name="contents[${index + 3}][content]"></div>
                        <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                    </fieldset>
                    <fieldset>
                        <label class="block text-sm text-gray-600">Gambar</label>
                        <div class="image-preview-container">
                            <input type="file" name="contents[${index + 3}][image]" class="edit-main-content-image mt-1 block w-full" accept="image/*">
                            <div class="relative mt-2">
                                <img src="${content.image_path ? '/storage/' + content.image_path : '#'}" 
                                    alt="Preview Gambar" 
                                    class="edit-main-content-image-preview ${content.image_path ? '' : 'hidden'} max-h-40 rounded-lg">
                                ${content.image_path ? `
                                    <button type="button" 
                                        onclick="deleteMainContentImage(this, ${content.id})"
                                        class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                        <i class="fas fa-times"></i>
                                    </button>
                                ` : ''}
                            </div>
                        </div>
                    </fieldset>
                </div>
            `;
            
            mainContainer.appendChild(contentDiv);
            
            // Initialize Quill editor for this content
            const editorElement = contentDiv.querySelector('.edit-main-content-editor');
            const editor = initQuill(editorElement);
            if (editor) {
                editor.root.innerHTML = content.content;
            }
            
            // Set up file input change listener
            const imageInput = contentDiv.querySelector('.edit-main-content-image');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const preview = this.parentElement.querySelector('.edit-main-content-image-preview');
                    const deleteButton = this.parentElement.querySelector('button');
                    
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            if (deleteButton) {
                                deleteButton.classList.remove('hidden');
                            }
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
        });
    }
    
    // Function to add new main content section in edit mode
    function addEditMainContent() {
        editMainContentCount++;
        const contentIndex = editMainContentCount + 2; // +2 because 0=intro, 1=first main content, 2=exercise
        
        const container = document.getElementById('edit-main-contents-container');
        const contentDiv = document.createElement('div');
        contentDiv.className = 'p-4 border-2 border-gray-200 rounded-xl space-y-4 edit-main-content-item';
        contentDiv.dataset.contentId = 'new-' + Date.now();
        
        contentDiv.innerHTML = `
            <div class="flex items-center justify-between mb-2">
                <h6 class="font-medium">Materi Utama Baru</h6>
                <button type="button" onclick="removeEditMainContent(this)"
                    class="text-red-500 hover:text-red-600">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <input type="hidden" name="contents[${contentIndex}][section_type]" value="materi_utama">
            <input type="hidden" name="contents[${contentIndex}][id]" class="edit-main-content-id">
            <div class="space-y-4">
                <fieldset>
                    <label class="block text-sm text-gray-600">Judul</label>
                    <input type="text" name="contents[${contentIndex}][title]" required
                        class="edit-main-content-title mt-1 block w-full rounded-xl border-2 border-gray-200 p-3">
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Konten</label>
                    <div class="edit-main-content-editor h-64 mb-4" data-name="contents[${contentIndex}][content]"></div>
                    <p class="mt-2 text-sm text-gray-500">Gunakan editor di atas untuk menambahkan konten dengan format yang lebih baik</p>
                </fieldset>
                <fieldset>
                    <label class="block text-sm text-gray-600">Gambar</label>
                    <div class="image-preview-container">
                        <input type="file" name="contents[${contentIndex}][image]" accept="image/*"
                            class="edit-main-content-image mt-1 block w-full">
                        <div class="relative mt-2">
                            <img src="#" alt="Preview Gambar" 
                                class="edit-main-content-image-preview hidden max-h-40 rounded-lg">
                        </div>
                    </div>
                </fieldset>
            </div>
        `;
        
        container.appendChild(contentDiv);
        
        // Initialize editor
        const editorElement = contentDiv.querySelector('.edit-main-content-editor');
        initQuill(editorElement);
        
        // Set up file input change listener
        const imageInput = contentDiv.querySelector('.edit-main-content-image');
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const preview = this.parentElement.querySelector('.edit-main-content-image-preview');
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    }
    
    // Function to remove main content section in edit mode
    function removeEditMainContent(button, contentId = null) {
        const contentItem = button.closest('.edit-main-content-item');
        if (contentItem) {
            // If we have an ID, we should add a delete flag
            if (contentId) {
                const deleteFlag = document.createElement('input');
                deleteFlag.type = 'hidden';
                deleteFlag.name = 'delete_content[]';
                deleteFlag.value = contentId;
                document.getElementById('edit_material_form').appendChild(deleteFlag);
            }
            
            contentItem.remove();
        }
    }
    
    // Function to delete image for main content
    function deleteMainContentImage(button, contentId) {
        const container = button.closest('.image-preview-container');
        if (container) {
            const preview = container.querySelector('.edit-main-content-image-preview');
            const input = container.querySelector('.edit-main-content-image');
            
            if (preview) {
                preview.src = '#';
                preview.classList.add('hidden');
            }
            if (input) {
                input.value = '';
            }
            
            button.classList.add('hidden');
            
            // Add delete image flag
            const deleteFlag = document.createElement('input');
            deleteFlag.type = 'hidden';
            deleteFlag.name = `delete_image_for_content[${contentId}]`;
            deleteFlag.value = '1';
            container.appendChild(deleteFlag);
        }
    }
    
    // Standard image preview/delete functions
    function handleImagePreview(inputId, previewId, deleteButtonId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const deleteButton = document.getElementById(deleteButtonId);
        
        if (input && preview && deleteButton && input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                deleteButton.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteImage(section) {
        const preview = document.getElementById(`edit_${section}_image_preview`);
        const input = document.getElementById(`edit_${section}_image`);
        const deleteButton = document.getElementById(`edit_${section}_delete_button`);
        
        if (preview) {
            preview.src = '#';
            preview.classList.add('hidden');
        }
        if (input) {
            input.value = '';
        }
        if (deleteButton) {
            deleteButton.classList.add('hidden');
        }
        
        // Add delete flag for server processing
        if (input && input.parentNode) {
            const deleteFlag = document.createElement('input');
            deleteFlag.type = 'hidden';
            deleteFlag.name = `contents[${section === 'introduction' ? '0' : section === 'main' ? '1' : '2'}][delete_image]`;
            deleteFlag.value = '1';
            input.parentNode.appendChild(deleteFlag);
        }
    }

    // Set up image preview event listeners when modal loads
    document.addEventListener('DOMContentLoaded', function() {
        const introImage = document.getElementById('edit_introduction_image');
        const exerciseImage = document.getElementById('edit_exercise_image');
        
        if (introImage) {
            introImage.addEventListener('change', function() {
                handleImagePreview('edit_introduction_image', 'edit_introduction_image_preview', 'edit_introduction_delete_button');
            });
        }

        if (exerciseImage) {
            exerciseImage.addEventListener('change', function() {
                handleImagePreview('edit_exercise_image', 'edit_exercise_image_preview', 'edit_exercise_delete_button');
            });
        }
        
        // Add form submission handler
        const editForm = document.getElementById('edit_material_form');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Process standard editor content
                const introEditor = document.querySelector('#edit_introduction_editor').querySelector('.ql-editor');
                const exerciseEditor = document.querySelector('#edit_exercise_editor').querySelector('.ql-editor');
                
                const introContent = document.getElementById('edit_introduction_content');
                introContent.value = introEditor.innerHTML;
                
                const exerciseContent = document.getElementById('edit_exercise_content');
                exerciseContent.value = exerciseEditor.innerHTML;
                
                // Process all main content editor content
                const mainContentItems = document.querySelectorAll('.edit-main-content-item');
                
                mainContentItems.forEach((item) => {
                    const editor = item.querySelector('.edit-main-content-editor');
                    if (editor) {
                        const name = editor.dataset.name;
                        const editorContent = editor.querySelector('.ql-editor').innerHTML;
                        
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = name;
                        hiddenInput.value = editorContent;
                        
                        editForm.appendChild(hiddenInput);
                        
                        // Add audio text for each main content if needed
                        const contentIndex = name.match(/contents\[(\d+)\]/)[1];
                        if (!editForm.querySelector(`input[name="contents[${contentIndex}][audio_text]"]`)) {
                            const audioInput = document.createElement('input');
                            audioInput.type = 'hidden';
                            audioInput.name = `contents[${contentIndex}][audio_text]`;
                            audioInput.value = '';
                            editForm.appendChild(audioInput);
                        }
                    }
                });
                
                // Submit the form
                editForm.submit();
            });
        }
    });
</script>
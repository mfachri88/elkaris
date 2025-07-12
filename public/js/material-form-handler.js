/**
 * Material Form Handler
 * Menangani interaksi form tambah/edit materi
 */

class MaterialFormHandler {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (!this.form) {
            console.error(`Form with ID ${formId} not found!`);
            return;
        }
        
        this.setupEventListeners();
        console.log(`MaterialFormHandler initialized for ${formId}`);
    }
    
    setupEventListeners() {
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    }
    
    handleSubmit(event) {
        event.preventDefault();
        
        // Validate required fields
        if (!this.validateForm()) {
            alert('Mohon lengkapi semua field yang diperlukan');
            return;
        }
        
        // Process editor content
        this.processEditorContent();
        
        // Submit form
        console.log('Form submission processing complete, submitting...');
        this.form.submit();
    }
    
    validateForm() {
        // Basic validation
        const requiredFields = [
            'title', 
            'description',
            'difficulty_level',
            'color'
        ];
        
        let valid = true;
        
        requiredFields.forEach(field => {
            const input = this.form.querySelector(`[name="${field}"]`);
            if (!input || !input.value.trim()) {
                console.error(`Required field missing: ${field}`);
                valid = false;
            }
        });
        
        // Validate content sections - PERBAIKAN: Hanya validasi section yang ada di form
        const availableSections = [];
        
        // Cek keberadaan section Pengenalan
        if (this.form.querySelector('[name="contents[0][section_type]"]')) {
            availableSections.push({ index: 0, name: 'pengenalan' });
        }
        
        // Cek keberadaan section Materi Utama
        if (this.form.querySelector('[name="contents[1][section_type]"]')) {
            availableSections.push({ index: 1, name: 'materi_utama' });
        }
        
        // Cek keberadaan section Latihan (jika masih digunakan)
        if (this.form.querySelector('[name="contents[2][section_type]"]')) {
            availableSections.push({ index: 2, name: 'latihan' });
        }
        
        // Validasi hanya untuk section yang tersedia
        availableSections.forEach(section => {
            const titleInput = this.form.querySelector(`[name="contents[${section.index}][title]"]`);
            if (!titleInput || !titleInput.value.trim()) {
                console.error(`Content title missing for ${section.name}`);
                valid = false;
            }
        });
        
        return valid;
    }
    
    processEditorContent() {
        // Definisikan semua editor yang mungkin ada
        const possibleEditors = [
            { selector: '#add_introduction_editor, #edit_introduction_editor', index: 0, type: 'pengenalan' },
            { selector: '#add_main_editor, #edit_main_editor', index: 1, type: 'materi_utama' },
            { selector: '#add_exercise_editor, #edit_exercise_editor', index: 2, type: 'latihan' }
        ];
        
        // Proses hanya editor yang ada di form
        possibleEditors.forEach(section => {
            const editorElement = this.form.querySelector(section.selector);
            if (!editorElement) return; // Skip jika editor tidak ditemukan
            
            const editor = editorElement.querySelector('.ql-editor');
            if (!editor) {
                console.error(`Quill editor not found for ${section.type}`);
                return;
            }
            
            // Create hidden input for content
            const contentInput = document.createElement('input');
            contentInput.type = 'hidden';
            contentInput.name = `contents[${section.index}][content]`;
            contentInput.value = editor.innerHTML;
            this.form.appendChild(contentInput);
            
            // Create hidden input for audio text if not exists
            if (!this.form.querySelector(`input[name="contents[${section.index}][audio_text]"]`)) {
                const audioInput = document.createElement('input');
                audioInput.type = 'hidden';
                audioInput.name = `contents[${section.index}][audio_text]`;
                audioInput.value = '';
                this.form.appendChild(audioInput);
            }
            
            console.log(`Processed content for section ${section.type}, length: ${contentInput.value.length}`);
        });
        
        // Proses editor untuk semua materi utama tambahan
        const mainContentItems = this.form.querySelectorAll('.main-content-item, .edit-main-content-item');
        mainContentItems.forEach((item, index) => {
            // Skip first main content if it's already processed
            if (index === 0 && this.form.querySelector('input[name="contents[1][content]"]')) {
                return;
            }
            
            // Determine the index for this content
            const sectionTypeInput = item.querySelector('input[name*="[section_type]"]');
            if (!sectionTypeInput) return;
            
            const nameMatch = sectionTypeInput.name.match(/contents\[(\d+)\]/);
            if (!nameMatch) return;
            
            const contentIndex = nameMatch[1];
            
            // Process editor content
            const editor = item.querySelector('.main-content-editor');
            if (editor) {
                const editorContent = editor.querySelector('.ql-editor')?.innerHTML;
                if (editorContent) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `contents[${contentIndex}][content]`;
                    hiddenInput.value = editorContent;
                    this.form.appendChild(hiddenInput);
                    
                    // Add audio text field if needed
                    if (!this.form.querySelector(`input[name="contents[${contentIndex}][audio_text]"]`)) {
                        const audioInput = document.createElement('input');
                        audioInput.type = 'hidden';
                        audioInput.name = `contents[${contentIndex}][audio_text]`;
                        audioInput.value = '';
                        this.form.appendChild(audioInput);
                    }
                    
                    console.log(`Processed additional main content ${contentIndex}, length: ${editorContent.length}`);
                }
            }
        });
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
    // Handle add material form
    if (document.getElementById('add_material_form')) {
        new MaterialFormHandler('add_material_form');
    }
    
    // Handle edit material form
    if (document.getElementById('edit_material_form')) {
        new MaterialFormHandler('edit_material_form');
    }
});
// Debug file untuk memantau proses pengiriman form materi

document.addEventListener('DOMContentLoaded', function() {
    // Add debug info for Quill editors
    function debugQuillEditors() {
        const editors = document.querySelectorAll('.ql-editor');
        console.log('Found', editors.length, 'Quill editors');
        
        editors.forEach((editor, index) => {
            console.log(`Editor ${index} content:`, editor.innerHTML.substring(0, 100) + '...');
        });
    }
    
    // Debug form submission
    const materialForms = document.querySelectorAll('form[action*="materials"]');
    console.log('Found', materialForms.length, 'material forms');
    
    materialForms.forEach((form, index) => {
        form.addEventListener('submit', function(e) {
            console.log(`Form ${index} is submitting...`);
            
            // Debug form data
            const formData = new FormData(form);
            console.log('Form data entries:');
            for (let [key, value] of formData.entries()) {
                if (typeof value === 'string') {
                    console.log(key, ':', value.substring(0, 100) + '...');
                } else {
                    console.log(key, ':', value);
                }
            }
            
            // Check for required fields
            let requiredFields = ['title', 'description', 'difficulty_level', 'color'];
            let missingFields = requiredFields.filter(field => !formData.has(field));
            
            if (missingFields.length > 0) {
                console.error('Missing required fields:', missingFields);
            }
            
            // Check for content fields
            let hasAllContent = true;
            for (let i = 0; i < 3; i++) {
                if (!formData.has(`contents[${i}][content]`)) {
                    console.error(`Missing content for section ${i}`);
                    hasAllContent = false;
                }
            }
            
            // Log submission attempt
            console.log(`Form submission ${hasAllContent ? 'looks good' : 'has issues'}`);
            
            debugQuillEditors();
        });
    });
    
    // Check if we're on the materials page
    if (window.location.href.includes('materials')) {
        console.log('Admin materials page detected, debug mode active');
        
        // Run initial debug
        setTimeout(debugQuillEditors, 1000);
    }
});

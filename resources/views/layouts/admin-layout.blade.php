<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="max-[8192px]:opacity-0 max-[3120px]:opacity-100 max-[3120px]:m-0 max-[3120px]:p-0 max-[3120px]:box-border max-[3120px]:[font-family:'Plus_Jakarta_Sans',Times,sans-serif,serif] max-[324px]:hidden">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index" />
    <meta name="description" content="{{ $deskripsi }}" />
    <meta property="og:title" content="{{ $judul }} | Elkaris" />
    <meta property="og:description" content="{{ $deskripsi }}" />
    <meta property="og:image" content="{{ asset("favicon.ico") }}" />
    <meta name="twitter:title" content="{{ $judul }} | Elkaris" />
    <meta name="twitter:description" content="{{ $deskripsi }}" />
    <meta name="twitter:image" content="{{ asset("favicon.ico") }}" />
    <title>{{ $judul }} | Elkaris</title>
    <link rel="icon" href="{{ Storage::url("favicon.ico") }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        function initQuill(selector) {
            const editor = new Quill(selector, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['clean']
                    ]
                }
            });
            
            // Capture content to corresponding hidden input before form submission
            const editorElement = document.querySelector(selector);
            const hiddenInputName = editorElement.dataset.name;
            
            if (editorElement.dataset.content) {
                editor.root.innerHTML = editorElement.dataset.content;
            }
            
            // Add this event to update hidden inputs before form submission
            const form = editorElement.closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = hiddenInputName;
                    hiddenInput.value = editor.root.innerHTML;
                    form.appendChild(hiddenInput);
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['clean']
            ];

            const initQuill = (selector) => {
                const container = document.querySelector(selector);
                if (container) {
                    const quill = new Quill(container, {
                        modules: {
                            toolbar: toolbarOptions
                        },
                        theme: 'snow'
                    });
                    // Sync quill content to hidden textarea for form submission
                    const form = container.closest('form');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = container.dataset.name;
                    form.appendChild(input);

                    quill.on('text-change', function() {
                        input.value = quill.root.innerHTML;
                    });

                    // For edit form, set initial content
                    if (container.dataset.content) {
                        quill.root.innerHTML = container.dataset.content;
                        input.value = container.dataset.content;
                    }
                }
            };
            
            // Initialize for add modal
            if(document.getElementById('add_material_modal')) {
                initQuill('#add_introduction_editor');
                initQuill('#add_main_editor'); 
                initQuill('#add_exercise_editor');
            }
            
            // Initialize for edit modal
            if(document.getElementById('edit_material_modal')) {
                initQuill('#edit_introduction_editor');
                initQuill('#edit_main_editor');
                initQuill('#edit_exercise_editor');
            }
        });
    </script>
    @viteReactRefresh
    @vite(["resources/js/app.js"])
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Material form handler -->
    <script src="{{ asset('js/material-form-handler.js') }}"></script>
    
    <!-- Debug script for admin panel -->
    @if(App::environment('local'))
        <script src="{{ asset('js/admin-debug.js') }}"></script>
    @endif
    
    <style>
        @media screen and (max-width: 3120px) {
            ::-webkit-scrollbar {
                display: none !important;
            }

            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus,
            input:-webkit-autofill:active {
                -webkit-text-fill-color: #374151 !important;
                -webkit-box-shadow: 0 0 0 30px #fceede inset !important;
                transition: background-color 5000s ease-in-out 0s;
                caret-color: #374151;
                box-shadow: 0 0 0 30px #fceede inset !important;
            }

            input:autofill {
                -webkit-text-fill-color: #374151 !important;
                box-shadow: 0 0 0 30px #fceede inset !important;
            }

            input[type="search"]::-webkit-search-cancel-button {
                -webkit-appearance: none;
                appearance: none;
            }
        }
    </style>
</head>

<body class="mx-auto overflow-x-hidden">
    <header class="fixed left-0 top-0 z-50 h-[4.5rem] w-screen border-b-2 border-gray-200 bg-[#A1E3F9] shadow-md">
        <div class="mx-auto flex h-full max-w-[90vw] items-center justify-between lg:max-w-[96vw]">
            <span class="flex items-center gap-3 lg:gap-6">
                <button type="button" onclick="toggleSidebar()"
                    class="rounded-xl p-3 text-gray-600 transition-colors hover:bg-[#f58a66]/10"
                    aria-label="Toggle Sidebar">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="/admin" class="flex items-center gap-2">
                      <img src="{{ asset('images/elkaris.png') }}" class="logo" style="width: 60px; height: auto;">
                </a>
            </span>

            <nav class="flex items-center gap-4">
                <a href="/"
                    class="flex items-center gap-2 rounded-xl px-4 py-2 text-gray-600 transition-colors hover:bg-[#f58a66]/10">
                    <i class="fas fa-home"></i>
                    <span class="hidden lg:inline">Tampilan Pengguna</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 rounded-xl px-4 py-2 text-gray-600 transition-colors hover:bg-[#f58a66]/10">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden lg:inline">Keluar</span>
                    </button>
                </form>
            </nav>
        </div>
    </header>

    @include("shared.sidebar.admin")

    <!-- Main Content -->
    <main class="transition-all duration-300 min-h-screen px-6 pt-28 pb-16 bg-white flex flex-col items-center lg:items-start ml-0 lg:ml-[16rem]">
        <div class="w-full max-w-7xl">
            {{ $slot }}
        </div>
    </main>

    <script>
        const sidebar = document.getElementById("sidebar");
        const mainContainer = document.querySelector("main");

        function toggleSidebar() {
            const isSidebarVisible = !sidebar.classList.contains('-translate-x-full');
            
            sidebar.classList.remove('translate-x-0', '-translate-x-full');
            mainContainer.classList.remove("ml-0", "ml-16", "lg:ml-[16rem]", "lg:items-start", "items-center");
            
            if (isSidebarVisible) {
                sidebar.classList.add('-translate-x-full');
                mainContainer.classList.add("ml-0", "items-center");
            } else {
                sidebar.classList.add('translate-x-0');
                mainContainer.classList.add("ml-16", "lg:ml-[16rem]", "lg:items-start");
            }
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                mainContainer.classList.remove("ml-0", "items-center");
                mainContainer.classList.add("ml-16", "lg:ml-[16rem]", "lg:items-start");
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                mainContainer.classList.remove("ml-16", "lg:ml-[16rem]", "lg:items-start");
                mainContainer.classList.add("ml-0", "items-center");
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                mainContainer.classList.remove("ml-0", "items-center");
                mainContainer.classList.add("ml-16", "lg:ml-[16rem]", "lg:items-start");
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                mainContainer.classList.remove("ml-16", "lg:ml-[16rem]", "lg:items-start");
                mainContainer.classList.add("ml-0", "items-center");
            }
        });

        function showAllActivities() {
            fetch('/admin/activities/data')
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'error') {
                        throw new Error(result.message);
                    }

                    const activities = result.data;

                    const existingModal = document.getElementById('activityModal');
                    if (existingModal) {
                        existingModal.remove();
                    }

                    const modalContent = document.createElement('div');
                    modalContent.innerHTML = `
                        <div id="activityModal" class="fixed inset-0 z-50 overflow-y-auto">
                            <div class="min-h-screen px-4 text-center">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                <div class="inline-block w-full max-w-2xl my-8 p-6 text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                                    <h2 class="text-xl font-semibold mb-4">Riwayat Aktivitas</h2>
                                    <div class="activities-container max-h-[60vh] overflow-y-auto space-y-4 p-2">
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <button type="button" onclick="close_modal('activityModal')"
                                            class="rounded-xl bg-gray-100 px-6 py-3 text-gray-700 hover:bg-gray-200">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(modalContent);

                    // Populate activities
                    const activitiesContainer = document.querySelector('.activities-container');
                    activitiesContainer.innerHTML = activities.map(activity => `
                        <div class="flex items-start gap-4 p-4 rounded-xl border-2 border-gray-100 hover:border-blue-100 transition-colors">
                            <div class="flex-shrink-0">
                                ${getActivityIcon(activity.type)}
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">${activity.title}</h3>
                                <p class="text-gray-600">${activity.description}</p>
                                <time datetime="${activity.created_at}" class="text-sm text-gray-500">
                                    ${moment(activity.created_at).fromNow()}
                                </time>
                            </div>
                        </div>
                    `).join('');

                    const modal = document.getElementById('activityModal');
                    modal.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat aktivitas');
                });
        }

        function getActivityIcon(type) {
            const icons = {
                'material_created': '<i class="fas fa-plus-circle text-green-500 text-xl"></i>',
                'material_updated': '<i class="fas fa-edit text-blue-500 text-xl"></i>',
                'material_deleted': '<i class="fas fa-trash text-red-500 text-xl"></i>',
                'material_completed': '<i class="fas fa-check-circle text-green-500 text-xl"></i>',
                'user_registered': '<i class="fas fa-user-plus text-green-500 text-xl"></i>',
                'user_updated': '<i class="fas fa-user-pen text-blue-500 text-xl"></i>',
                'user_deleted': '<i class="fas fa-user-xmark text-red-500 text-xl"></i>',
                'exercise_completed': '<i class="fas fa-check-circle text-green-500 text-xl"></i>',
                'exercise_created': '<i class="fas fa-plus-circle text-green-500 text-xl"></i>',
                'exercise_updated': '<i class="fas fa-edit text-blue-500 text-xl"></i>',
                'exercise_deleted': '<i class="fas fa-trash text-red-500 text-xl"></i>'
            };
            return icons[type] || '<i class="fas fa-info-circle text-gray-500 text-xl"></i>';
        }

        function close_modal(id_modal) {
            const modal = document.getElementById(id_modal);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

    </script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.js"></script>
    <script>
        moment.locale('id');
    </script>
 
</body>

</html>
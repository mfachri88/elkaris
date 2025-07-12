<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}"
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
  <meta name="chat-conversation-id" content="{{ session('chat_conversation_id', '') }}">
  <title>{{ $judul }} | Elkaris</title>
  <link rel="icon" href="{{ Storage::url('favicon.ico') }}" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
  @viteReactRefresh
  @vite(["resources/js/app.js"])
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="{{ auth()->check() ? 'auth' : '' }}">
  @include("layouts.forest-background")

  @php 
    // Add default value for $halaman_khusus if not set
    $halaman_khusus = $halaman_khusus ?? false;
  @endphp

  @if ($auth ?? true)
    @include("shared.header.header")
  @endif

  @if (!$halaman_khusus)
    @include("shared.sidebar.student")
  @endif

  <main class="transition-all duration-300 min-h-screen px-6 bg-white {{ !$halaman_khusus ? 'ml-0 lg:ml-[16rem] pt-28 pb-16' : 'flex justify-center' }}">
    <div class="w-full max-w-7xl mx-auto">
      {{ $slot }}
    </div>
  </main>

  <script>
    const sidebar = document.getElementById("sidebar");
    const mainContainer = document.querySelector("main");
    const menuButton = document.getElementById("menu-button");

    function initializeSidebar() {
        if (window.innerWidth < 1024) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            mainContainer.classList.remove("ml-16", "lg:ml-[16rem]");
            mainContainer.classList.add("ml-0");
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            mainContainer.classList.remove("ml-0");
            mainContainer.classList.add("ml-16", "lg:ml-[16rem]");
        }
    }

    document.addEventListener('DOMContentLoaded', initializeSidebar);

    function toggleSidebar() {
        const isSidebarOpen = !sidebar.classList.contains('-translate-x-full');
        
        sidebar.classList.remove('translate-x-0', '-translate-x-full', 'lg:translate-x-0');
        mainContainer.classList.remove("ml-0", "ml-16", "lg:ml-[16rem]");
        
        if (isSidebarOpen) {
            sidebar.classList.add('-translate-x-full');
            mainContainer.classList.add("ml-0");
        } else {
            sidebar.classList.add('translate-x-0');
            mainContainer.classList.add("ml-16", "lg:ml-[16rem]");
        }
    }

    menuButton.addEventListener('click', toggleSidebar);

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            if (!sidebar.classList.contains('-translate-x-full')) {
                mainContainer.classList.remove("ml-0");
                mainContainer.classList.add("ml-16", "lg:ml-[16rem]");
            }
        } else {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            mainContainer.classList.remove("ml-16", "lg:ml-[16rem]");
            mainContainer.classList.add("ml-0");
        }
    });
  </script>
</body>

</html>
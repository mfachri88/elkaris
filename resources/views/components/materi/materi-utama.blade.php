
@component("layouts.main-layout", ["judul" => "Materi Utama {$materi['title']} | Elkaris", "deskripsi" => $materi['description'], "halaman_khusus" => false])
<main class="min-h-screen px-6 bg-white">
  <section class="bg-green-50 rounded-2xl border-4 border-green-200 p-8 shadow-lg hover:shadow-xl transition-shadow"
    role="article">
    <header class="flex flex-col-reverse items-start gap-4 mb-8 lg:flex-row lg:items-center">
      <i class="fa-solid fa-book hidden bg-green-100 p-4 rounded-xl text-green-500 text-3xl lg:inline"></i>
      <h2 class="text-xl font-bold text-green-700 lg:text-3xl">
        Materi Utama
      </h2>
    </header>
    
    @if($mainContents->isEmpty())
      <div class="p-4 bg-white rounded-lg">
        <p class="text-gray-600">Materi utama belum tersedia.</p>
      </div>
    @else
      @foreach($mainContents as $index => $content)
        <article class="mb-8 p-6 bg-white rounded-xl shadow-sm">
          <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $content->title }}</h3>
          
          @if($content->image_path)
            <figure class="mb-4">
              <img src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" 
                class="max-h-96 w-auto mx-auto rounded-lg">
            </figure>
          @endif
          
          <div class="prose max-w-none mt-4">
            {!! $content->content !!}
          </div>
          
          
        </article>
      @endforeach
    @endif

    <nav class="mt-8 flex flex-col justify-center items-center gap-4 lg:flex-row lg:justify-between">
      <a href="{{ route('materi.show.introduction', $materi['id']) }}"
        class="mt-4 w-full flex items-center justify-center gap-2 text-white bg-blue-600 rounded-xl px-6 py-4 hover:bg-blue-700 transform transition-colors lg:mt-0 lg:w-fit"
        aria-label="Kembali ke halaman perkenalan">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Perkenalan</span>
      </a>
      <form action="{{ route('materi.complete', $materi['id']) }}" method="POST" class="w-full lg:w-fit">
        @csrf
        <button type="submit" 
          class="mt-4 w-full flex items-center justify-center gap-2 text-white bg-green-600 rounded-xl px-6 py-4 hover:bg-green-700 transform transition-colors lg:mt-0">
          <span>Selesai Belajar</span>
          <i class="fa-solid fa-check"></i>
        </button>
      </form>
    </nav>
  </section>
</main>
@endcomponent

<script>
  document.addEventListener("DOMContentLoaded", () => {
  
    
    // Handle form submission with alert
    const completeForm = document.querySelector('form[action*="complete"]');
    if (completeForm) {
      completeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Memproses... <i class="fa-solid fa-spinner fa-spin"></i>';
        
        // Submit the form using fetch
        fetch(this.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: new FormData(this)
        })
        .then(response => {
          if (!response.ok) throw new Error('Network response was not ok');
          // Show success message
          alert('Selamat! Kamu telah menyelesaikan materi ini');
          // Redirect to materi index
          window.location.href = "{{ route('materi.index') }}";
        })
        .catch(error => {
          console.error('Error:', error);
          submitButton.disabled = false;
          submitButton.innerHTML = 'Selesai Belajar <i class="fa-solid fa-check"></i>';
          alert("Terjadi kesalahan saat menyelesaikan materi");
        });
      });
    }
  });
</script>
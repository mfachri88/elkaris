@component("layouts.main-layout", [
    "judul" => "Tes Minat Bakat",
    "deskripsi" => "Temukan jalur karir yang cocok dengan minat dan bakat Anda",
    "halaman_khusus" => false
])

<main class="px-4 py-6 lg:px-8">
  <section class="mb-10">
    <div class="flex justify-between items-center">
      <div>
        <h1 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Tes Minat Bakat</h1>
        <p class="mb-8 text-lg text-gray-600">
          Tes ini akan membantu Anda mengetahui minat dan bakat Anda dalam berbagai bidang.
          Silakan nilai setiap pernyataan sesuai dengan tingkat kesetujuan Anda.
        </p>
      </div>
      <div>
        <a href="{{ route('tes-minat-bakat.history') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
          <i class="fas fa-history"></i>
          Riwayat Tes
        </a>
      </div>
    </div>
    
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
      <div class="flex">
        <div class="flex-shrink-0">
          <i class="fa-solid fa-circle-info text-blue-500"></i>
        </div>
        <div class="ml-3">
          <p class="text-blue-700">
            Berikan penilaian terhadap setiap pernyataan dengan skala 1-5:
          </p>
          <ul class="list-disc ml-5 mt-2 text-blue-700">
            <li>1 = Sangat Tidak Setuju</li>
            <li>2 = Tidak Setuju</li>
            <li>3 = Netral</li>
            <li>4 = Setuju</li>
            <li>5 = Sangat Setuju</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <form action="{{ route('tes-minat-bakat.submit') }}" method="POST" class="mb-10">
    @csrf
    <div class="grid gap-6 mb-8">
      @foreach($questions as $i => $questions)
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-amber-500">
          <h3 class="text-lg font-medium text-gray-800 mb-4">{{ $i + 1 }}. {{ $questions['text'] }}</h3>
          <div class="grid grid-cols-5 gap-4">
            @for($j = 1; $j <= 5; $j++)
            <label class="relative">
              <input type="radio" name="answers[{{ $questions['id'] }}]" value="{{ $j }}" class="sr-only peer" required>
              <div class="flex flex-col items-center justify-center w-14 h-14 rounded-lg border-2 border-gray-300 cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                <span class="text-xl font-bold text-gray-700">{{ $j }}</span>
              </div>
            </label>
            @endfor
          </div>
        </div>
      @endforeach
    </div>

    <div class="flex justify-center">
      <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-medium shadow-sm hover:bg-blue-700 transition-colors">
        Lihat Hasil
      </button>
    </div>
  </form>
</main>

@endcomponent
<header class="flex items-center gap-6 mb-8">
    <span class="relative">
        <i class="fa-solid fa-pencil-alt bg-[#fceede] p-6 rounded-xl inline-block text-[#f58a66] text-4xl"></i>
        <i class="fa-solid fa-star absolute -top-2 -right-2 bg-blue-100 p-2 rounded-full text-blue-500"></i>
    </span>
    <span>
        <h2 class="text-4xl font-bold text-gray-800">Latihan Soal 📝</h2>
        <h5 class="mt-3">
            Yuk, asah kemampuanmu dengan mengerjakan soal-soal seru!
        </h5>
    </span>
</header>

<section class="flex flex-col gap-4 lg:flex-row lg:items-center mb-4">
  <i class="fa-solid fa-pen-to-square w-fit bg-[#fceede] p-4 rounded-xl text-[#f58a66] text-3xl" aria-hidden="true"></i>
  <div>
    <div class="mt-4 flex items-center gap-3">
      <i class="fa-solid fa-check-circle bg-green-100 p-3 rounded-lg text-green-500 text-xl"></i>
      <div>
        <p class="text-gray-600">Soal Selesai</p>
        <h5 class="text-xl font-bold text-gray-800">{{ $completedExercises }}</h5>
      </div>
    </div>
    <div class="mt-4 flex items-center gap-3">
      <i class="fa-solid fa-trophy bg-yellow-100 p-3 rounded-lg text-yellow-500 text-xl"></i>
      <div>
        <p class="text-gray-600">Nilai Tertinggi</p>
        <h5 class="text-xl font-bold text-gray-800">{{ $bestScore }}</h5>
      </div>
    </div>
  </div>
</section>
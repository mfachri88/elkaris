<main class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
    <section class="col-span-full">
        <h3 class="mb-4 text-lg font-semibold text-gray-800 lg:text-xl">Aksi Cepat</h3>
    </section>

    <a href="{{ route('admin.materials.index', ['open_modal' => 'true']) }}"
        class="flex items-center gap-4 rounded-xl border-2 border-blue-100 bg-blue-50 p-6 transition-all hover:shadow-lg">
        <span class="rounded-xl bg-blue-100 p-4">
            <i class="fa-solid fa-book text-2xl text-blue-500"></i>
        </span>
        <div>
            <h3 class="text-lg font-semibold text-blue-700">Tambah Materi</h3>
            <p class="text-blue-600">Buat materi baru</p>
        </div>
    </a>

    <a href="{{ route('admin.exercises.index', ['open_modal' => 'true']) }}"
        class="flex items-center gap-4 rounded-xl border-2 border-purple-100 bg-purple-50 p-6 transition-all hover:shadow-lg">
        <span class="rounded-xl bg-purple-100 p-4">
            <i class="fa-solid fa-pencil text-2xl text-purple-500"></i>
        </span>
        <div>
            <h3 class="text-lg font-semibold text-purple-700">Tambah Latihan</h3>
            <p class="text-purple-600">Buat latihan soal baru</p>
        </div>
    </a>

    <a href="{{ route('admin.career-test.manage') }}"
        class="flex items-center gap-4 rounded-xl border-2 border-green-100 bg-green-50 p-6 transition-all hover:shadow-lg">
        <span class="rounded-xl bg-green-100 p-4">
            <i class="fa-solid fa-brain text-2xl text-green-500"></i>
        </span>
        <div>
            <h3 class="text-lg font-semibold text-green-700">Kelola Tes Minat Bakat</h3>
            <p class="text-green-600">Tambah dan edit pertanyaan tes</p>
        </div>
    </a>
</main>

@component("layouts.main-layout", [
    "judul" => "Edit Profil",
    "deskripsi" => "",
    "halaman_khusus" => false
])
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<section class="min-h-screen px-6 bg-white">
    @if(session('success'))
        <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <article class="bg-white p-8 rounded-xl border-4 border-[#f58a66]/20 shadow-md mb-8">
        <header class="flex items-center gap-4 mb-8">
            <i class="fa-solid fa-user text-2xl text-[#f58a66] bg-[#fceede] p-4 rounded-xl"></i>
            <h2 class="text-2xl font-bold text-gray-800">
                Informasi Pribadi
            </h2>
        </header>

        <form action="{{ route('profil.update') }}" method="post" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIS (Readonly) -->
                <fieldset>
                    <label for="nis" class="block text-lg font-medium text-gray-700 mb-2">NIS</label>
                    <input type="text" id="nis" name="nis" value="{{ Auth::user()->nis }}" readonly
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed">
                    <small class="text-gray-500">NIS tidak dapat diubah</small>
                </fieldset>

                <!-- Nama -->
                <fieldset>
                    <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors">
                </fieldset>

                <!-- Email -->
                <fieldset>
                    <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors">
                </fieldset>

                <!-- Kelas -->
                <fieldset>
                    <label for="kelas" class="block text-lg font-medium text-gray-700 mb-2">Kelas</label>
                    <input type="text" id="kelas" name="kelas" value="{{ Auth::user()->kelas }}"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors">
                </fieldset>

                <!-- Jurusan -->
                <fieldset>
                    <label for="jurusan" class="block text-lg font-medium text-gray-700 mb-2">Jurusan</label>
                    <select id="jurusan" name="jurusan"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors">
                        <option value="">Pilih Jurusan</option>
                        <option value="IPA" {{ Auth::user()->jurusan == 'IPA' ? 'selected' : '' }}>IPA</option>
                        <option value="IPS" {{ Auth::user()->jurusan == 'IPS' ? 'selected' : '' }}>IPS</option>
                    </select>
                </fieldset>

                <!-- Jenis Kelamin -->
                <fieldset>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="L" {{ Auth::user()->jenis_kelamin == 'L' ? 'checked' : '' }}
                                class="h-4 w-4 text-[#f58a66] border-gray-300 focus:ring-[#f58a66]">
                            <span>Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="P" {{ Auth::user()->jenis_kelamin == 'P' ? 'checked' : '' }}
                                class="h-4 w-4 text-[#f58a66] border-gray-300 focus:ring-[#f58a66]">
                            <span>Perempuan</span>
                        </label>
                    </div>
                </fieldset>
            </div>

            <span class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-[#f58a66] text-white rounded-lg hover:bg-[#f47951] transition-colors focus:ring-4 focus:ring-[#fceede]">
                    Simpan Perubahan
                </button>
            </span>
        </form>
    </article>

    <article class="bg-white p-8 rounded-xl border-4 border-[#f58a66]/20 shadow-md">
        <header class="flex items-center gap-4 mb-8">
            <span class="bg-[#fceede] p-4 rounded-xl">
                <i class="fa-solid fa-lock text-[#f58a66] text-2xl"></i>
            </span>
            <h2 class="text-2xl font-bold text-gray-800">Ubah Password</h2>
        </header>

        <form action="{{ route('profil.password') }}" method="post" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <fieldset>
                    <label for="current_password" class="block text-lg font-medium text-gray-700 mb-2">Password Saat Ini</label>
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
                    />
                </fieldset>

                <fieldset>
                    <label for="new_password" class="block text-lg font-medium text-gray-700 mb-2">Password Baru</label>
                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
                    />
                </fieldset>

                <fieldset>
                    <label for="new_password_confirmation" class="block text-lg font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
                    />
                </fieldset>
            </div>

            <span class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#f58a66] text-white rounded-lg hover:bg-[#f47951] transition-colors focus:ring-4 focus:ring-[#fceede]">
                    Simpan Password
                </button>
            </span>
        </form>
    </article>
</section>
@endcomponent
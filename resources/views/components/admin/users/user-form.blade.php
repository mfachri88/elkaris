<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if($method ?? false)
        @method($method)
    @endif

    <div>
        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">
            Nama
        </label>
        <input
            type="text" 
            id="name" 
            name="name" 
            value="{{ old('name', $user->name ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        />
        @error('name')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="nis" class="block text-lg font-medium text-gray-700 mb-2">
            NIS
        </label>
        <input
            type="number" 
            id="nis" 
            name="nis" 
            value="{{ old('nis', $user->nis ?? '') }}"
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        />
        @error('nis')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email</label>
        <input
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email', $user->email ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        />
        @error('email')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="kelas" class="block text-lg font-medium text-gray-700 mb-2">
            Kelas
        </label>
        <input
            type="text" 
            id="kelas" 
            name="kelas" 
            value="{{ old('kelas', $user->kelas ?? '') }}"
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        />
        @error('kelas')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="jurusan" class="block text-lg font-medium text-gray-700 mb-2">
            Jurusan
        </label>
        <select
            id="jurusan" 
            name="jurusan"
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        >
            <option value="">Pilih Jurusan</option>
            @foreach(\App\Models\User::getJurusanOptions() as $value => $label)
                <option value="{{ $value }}" {{ old('jurusan', $user->jurusan ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('jurusan')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="jenis_kelamin" class="block text-lg font-medium text-gray-700 mb-2">
            Jenis Kelamin
        </label>
        <select
            id="jenis_kelamin" 
            name="jenis_kelamin"
            class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
        >
            <option value="">Pilih Jenis Kelamin</option>
            @foreach(\App\Models\User::getJenisKelaminOptions() as $value => $label)
                <option value="{{ $value }}" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('jenis_kelamin')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-lg font-medium text-gray-700 mb-2">
            {{ isset($user) ? 'Kata Sandi Baru (Kosongkan Jika Tidak Ingin Mengubah)' : 'Kata Sandi' }}
        </label>
        <div class="relative">
            <input
                type="password" 
                id="password" 
                name="password"
                class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
                {{ !isset($user) ? 'required' : '' }}
            />
            <i
                onclick="ShowPassword('password')"
                class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-[#f58a66] focus:outline-none"
                id="password-icon"
            ></i>
        </div>
        @error('password')
            <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-lg font-medium text-gray-700 mb-2">Konfirmasi Password</label>
        <span class="relative">
            <input
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="w-full px-4 py-3 rounded-lg border-2 border-[#f58a66]/20 focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors"
                {{ !isset($user) ? 'required' : '' }}
            />
            <i
                onclick="ShowPassword('password_confirmation')"
                class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-[#f58a66] focus:outline-none"
                id="password_confirmation-icon"
            ></i>
        </span>
    </div>

    <div class="flex items-center gap-2">
        <input
            type="checkbox" 
            id="is_admin" 
            name="is_admin" 
            value="1"
            class="w-4 h-4 text-[#f58a66] border-gray-300 rounded focus:ring-[#f58a66]"
            {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}
        />
        <label for="is_admin" class="text-lg font-medium text-gray-700">
            Admin
        </label>
    </div>

    <div class="flex flex-col-reverse gap-4 text-center lg:flex-row lg:justify-end">
        <a
            href="{{ route('admin.users.index') }}" 
            class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
        >
            Batal
        </a>
        <button
            type="submit"
            class="px-6 py-3 bg-[#f58a66] text-white rounded-lg hover:bg-[#f47951] transition-colors"
        >
            {{ $submitText }}
        </button>
    </div>
</form>

<script>
    function ShowPassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(`${inputId}-icon`);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
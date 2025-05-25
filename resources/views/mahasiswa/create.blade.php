<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-red-800 leading-tight tracking-wide drop-shadow">
                {{ __('Tambah Mahasiswa Baru') }}
            </h2>
            <a href="{{ route('mahasiswa.index') }}" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-700 hover:to-red-900 text-white font-bold py-2 px-4 rounded-lg flex items-center shadow transition-all duration-200">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-red-100 via-red-50 to-white rounded-2xl shadow-2xl border border-red-200 overflow-hidden">
                <div class="p-8 text-gray-900">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex items-center gap-2 shadow">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <div>
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-red-700 border-b-2 border-red-100 pb-2 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Data Akun
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                    <input type="password" name="password" id="password" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-red-700 border-b-2 border-red-100 pb-2 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Data Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM <span class="text-red-500">*</span></label>
                                    <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('nim') border-red-500 @enderror">
                                    @error('nim')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('tempat_lahir') border-red-500 @enderror">
                                    @error('tempat_lahir')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror">
                                    @error('tanggal_lahir')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('jenis_kelamin') border-red-500 @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                                    <textarea name="alamat" id="alamat" rows="3" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-red-700 border-b-2 border-red-100 pb-2 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 018 0v2m-4-4a4 4 0 100-8 4 4 0 000 8z" />
                                </svg>
                                Data Akademik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-1">Jurusan <span class="text-red-500">*</span></label>
                                    <select name="jurusan_id" id="jurusan_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('jurusan_id') border-red-500 @enderror">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1">Program Studi <span class="text-red-500">*</span></label>
                                    <select name="prodi_id" id="prodi_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('prodi_id') border-red-500 @enderror">
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}" data-jurusan="{{ $prodi->jurusan_id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                                {{ $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-1">Angkatan <span class="text-red-500">*</span></label>
                                    <select name="angkatan" id="angkatan" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('angkatan') border-red-500 @enderror">
                                        <option value="">Pilih Angkatan</option>
                                        @for ($i = date('Y'); $i >= date('Y')-6; $i--)
                                            <option value="{{ $i }}" {{ old('angkatan') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('angkatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('status') border-red-500 @enderror">
                                        <option value="">Pilih Status</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="cuti" {{ old('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                        <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="do" {{ old('status') == 'do' ? 'selected' : '' }}>Drop Out</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dosen_wali_id" class="block text-sm font-medium text-gray-700 mb-1">Dosen Wali <span class="text-red-500">*</span></label>
                                    <select name="dosen_wali_id" id="dosen_wali_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('dosen_wali_id') border-red-500 @enderror">
                                        <option value="">Pilih Dosen Wali</option>
                                        @foreach (\App\Models\Dosen::with('user')->get() as $dosen)
                                            <option value="{{ $dosen->id }}" {{ old('dosen_wali_id') == $dosen->id ? 'selected' : '' }}>
                                                {{ $dosen->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dosen_wali_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="inline-flex items-center justify-center py-2 px-6 border border-transparent shadow-lg text-base font-semibold rounded-lg text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jurusanSelect = document.getElementById('jurusan_id');
            const prodiSelect = document.getElementById('prodi_id');

            // Filter prodi based on selected jurusan
            function filterProdi() {
                const jurusanId = jurusanSelect.value;

                // Hide all prodi options first
                Array.from(prodiSelect.options).forEach(option => {
                    if (option.value === '') return; // Skip the placeholder option
                    option.style.display = 'none';
                });

                // Show only prodi options for the selected jurusan
                if (jurusanId) {
                    Array.from(prodiSelect.options).forEach(option => {
                        if (option.dataset.jurusan === jurusanId) {
                            option.style.display = '';
                        }
                    });

                    // Or fetch via AJAX
                    fetch(`/mahasiswa/get-prodi/${jurusanId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear existing options except the first one
                            while (prodiSelect.options.length > 1) {
                                prodiSelect.remove(1);
                            }

                            // Add new options
                            data.forEach(prodi => {
                                const option = document.createElement('option');
                                option.value = prodi.id;
                                option.textContent = prodi.nama_prodi;
                                prodiSelect.appendChild(option);
                            });
                        });
                }

                // Reset prodi selection
                prodiSelect.value = '';
            }

            jurusanSelect.addEventListener('change', filterProdi);

            // Initial filter on page load if jurusan is pre-selected
            if (jurusanSelect.value) {
                filterProdi();
            }
        });
    </script>
</x-app-layout>

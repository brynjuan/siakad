<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('Edit Data Mahasiswa') }}
            </h2>
            <a href="{{ route('mahasiswa.index') }}" class="bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-bold py-2 px-4 rounded-md flex items-center transition duration-300 shadow-md border border-gray-700">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen" style="background: linear-gradient(135deg, #fbeee6 0%, #f8fafc 100%);">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-red-100">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-10">
                            <h3 class="text-lg font-semibold text-white mb-4 bg-gradient-to-r from-red-700 to-red-800 py-2 px-4 rounded-md shadow flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Data Akun
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gradient-to-br from-red-50 via-white to-red-100 p-6 rounded-lg border border-red-200 shadow">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $mahasiswa->user->name) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $mahasiswa->user->email) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400">
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-semibold text-white mb-4 bg-gradient-to-r from-red-700 to-red-800 py-2 px-4 rounded-md shadow flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0-4h.01"/>
                                </svg>
                                Data Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gradient-to-br from-red-50 via-white to-red-100 p-6 rounded-lg border border-red-200 shadow">
                                <div class="mb-4">
                                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                    @error('nim')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                        @error('tempat_lahir')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ? $mahasiswa->tanggal_lahir->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                        @error('tanggal_lahir')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <div class="mt-2 flex space-x-6">
                                        <div class="flex items-center">
                                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L' ? 'checked' : '' }} class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                            <label for="jenis_kelamin_l" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P' ? 'checked' : '' }} class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                            <label for="jenis_kelamin_p" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-semibold text-white mb-4 bg-gradient-to-r from-red-700 to-red-800 py-2 px-4 rounded-md shadow flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 14h8"/>
                                </svg>
                                Data Akademik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gradient-to-br from-red-50 via-white to-red-100 p-6 rounded-lg border border-red-200 shadow">
                                <div>
                                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                    <select name="jurusan_id" id="jurusan_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $mahasiswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                                    <select name="prodi_id" id="prodi_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                        <option value="">Pilih Program Studi</option>
                                        @foreach($prodis as $prodi)
                                            <option value="{{ $prodi->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : '' }}
                                                data-jurusan="{{ $prodi->jurusan_id }}">
                                                {{ $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                                    <input type="number" name="angkatan" id="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" min="2000" max="{{ date('Y') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                    @error('angkatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-200 hover:border-red-400" required>
                                        <option value="aktif" {{ old('status', $mahasiswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="cuti" {{ old('status', $mahasiswa->status) == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                        <option value="lulus" {{ old('status', $mahasiswa->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="do" {{ old('status', $mahasiswa->status) == 'do' ? 'selected' : '' }}>Drop Out</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('mahasiswa.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-700 hover:from-gray-700 hover:to-gray-900 text-white font-bold py-2 px-4 rounded-md mr-2 transition duration-300 shadow-md border border-gray-700">
                                Batal
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-900 text-white font-bold py-2 px-6 rounded-md transition duration-300 shadow-md flex items-center border border-red-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
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
            const prodiOptions = Array.from(prodiSelect.querySelectorAll('option'));

            // Filter prodi based on selected jurusan
            function filterProdi() {
                const jurusanId = jurusanSelect.value;

                // Clear prodi dropdown
                prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';

                if (jurusanId) {
                    // Add filtered options
                    prodiOptions.forEach(option => {
                        if (option.dataset.jurusan === jurusanId || option.value === '') {
                            prodiSelect.appendChild(option.cloneNode(true));
                        }
                    });
                }
            }

            // Update on jurusan change
            jurusanSelect.addEventListener('change', filterProdi);
        });
    </script>
</x-app-layout>

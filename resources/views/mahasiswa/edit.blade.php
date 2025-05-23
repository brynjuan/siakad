<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- User Info -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <h3 class="text-lg font-medium mb-4">Informasi Akun</h3>

                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $mahasiswa->user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $mahasiswa->user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <h3 class="text-lg font-medium mb-4">Informasi Pribadi</h3>

                                <div class="mb-4">
                                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('nim')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        @error('tempat_lahir')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        @error('tanggal_lahir')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <div class="mt-2 flex space-x-4">
                                        <div class="flex items-center">
                                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                            <label for="jenis_kelamin_l" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                            <label for="jenis_kelamin_p" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Academic Info -->
                        <div class="border p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium mb-4">Informasi Akademik</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                    <select name="jurusan_id" id="jurusan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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
                                    <select name="prodi_id" id="prodi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                                    <input type="number" name="angkatan" id="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" min="2000" max="{{ date('Y') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('angkatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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
                            <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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

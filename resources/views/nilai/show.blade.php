<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Input Nilai Mahasiswa') }}
            </h2>
            <a href="{{ route('nilai.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Class Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Informasi Kelas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-semibold">Mata Kuliah:</span>
                            {{ $kelas->mataKuliah->nama_mk }} ({{ $kelas->mataKuliah->kode_mk }})
                        </div>
                        <div>
                            <span class="font-semibold">Kelas:</span>
                            {{ $kelas->nama_kelas }}
                        </div>
                        <div>
                            <span class="font-semibold">SKS:</span>
                            {{ $kelas->mataKuliah->sks }}
                        </div>
                        <div>
                            <span class="font-semibold">Tahun Ajaran:</span>
                            {{ $kelas->tahun_ajaran }} ({{ $kelas->semester }})
                        </div>
                        <div>
                            <span class="font-semibold">Jumlah Mahasiswa:</span>
                            {{ $students->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konversi Nilai Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-2">Konversi Nilai</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm">
                        <div>A = 85-100</div>
                        <div>A- = 80-84</div>
                        <div>B+ = 75-79</div>
                        <div>B = 70-74</div>
                        <div>B- = 65-69</div>
                        <div>C+ = 60-64</div>
                        <div>C = 55-59</div>
                        <div>C- = 50-54</div>
                        <div>D = 40-49</div>
                        <div>E = 0-39</div>
                    </div>
                </div>
            </div>

            <!-- Input Nilai Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('nilai.update', $kelas->id) }}" method="POST">
                        @csrf

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIM</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Mahasiswa</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nilai Angka</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nilai Huruf</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $index => $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $student->mahasiswa->nim }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $student->mahasiswa->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <input type="number" name="nilai[{{ $student->id }}]"
                                                   value="{{ old('nilai.'.$student->id, $student->nilai->nilai_angka ?? '') }}"
                                                   class="w-24 rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                                   min="0" max="100" step="0.01"
                                                   onchange="updateNilaiHuruf(this)">
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span id="huruf-{{ $student->id }}" class="font-semibold">
                                                {{ $student->nilai->nilai_huruf ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <input type="text" name="keterangan[{{ $student->id }}]"
                                                   value="{{ old('keterangan.'.$student->id, $student->nilai->keterangan ?? '') }}"
                                                   class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">Tidak ada mahasiswa yang terdaftar di kelas ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($students->count() > 0)
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Nilai
                            </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateNilaiHuruf(input) {
            const value = parseFloat(input.value);
            const krsId = input.name.match(/\[(\d+)\]/)[1];
            const hurufElement = document.getElementById('huruf-' + krsId);

            let huruf = '-';
            if (!isNaN(value)) {
                if (value >= 85) huruf = 'A';
                else if (value >= 80) huruf = 'A-';
                else if (value >= 75) huruf = 'B+';
                else if (value >= 70) huruf = 'B';
                else if (value >= 65) huruf = 'B-';
                else if (value >= 60) huruf = 'C+';
                else if (value >= 55) huruf = 'C';
                else if (value >= 50) huruf = 'C-';
                else if (value >= 40) huruf = 'D';
                else huruf = 'E';
            }

            hurufElement.textContent = huruf;
        }
    </script>
</x-app-layout>

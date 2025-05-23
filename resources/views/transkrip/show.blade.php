<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transkrip Nilai Semester') }} {{ ucfirst($request->semester) }} {{ $request->tahun_ajaran }}
            </h2>
            <a href="{{ route('transkrip.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-semibold">Nama:</span>
                            {{ $mahasiswa->user->name }}
                        </div>
                        <div>
                            <span class="font-semibold">NIM:</span>
                            {{ $mahasiswa->nim }}
                        </div>
                        <div>
                            <span class="font-semibold">Program Studi:</span>
                            {{ $mahasiswa->prodi->nama_prodi }}
                        </div>
                        <div>
                            <span class="font-semibold">Semester:</span>
                            {{ ucfirst($request->semester) }} {{ $request->tahun_ajaran }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mata Kuliah Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nilai Angka</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nilai Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mataKuliah as $index => $krs)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->kelas->mataKuliah->sks }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->nilai->nilai_angka }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->nilai->nilai_huruf }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">Tidak ada data nilai untuk semester ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-50">
                                    <td colspan="3" class="px-6 py-4 font-semibold text-right border-b border-gray-200">Total SKS:</td>
                                    <td class="px-6 py-4 font-semibold border-b border-gray-200">{{ $totalSksSemester }}</td>
                                    <td colspan="2" class="px-6 py-4 border-b border-gray-200"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- IP Semester Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium">Indeks Prestasi Semester:</h3>
                        <div class="bg-blue-100 text-blue-800 rounded-lg px-6 py-3 text-xl font-bold border border-blue-300">
                            {{ number_format($ipSemester, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

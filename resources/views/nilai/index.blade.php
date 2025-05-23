<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengisian Nilai Mahasiswa') }}
            </h2>
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

            <!-- Tahun Ajaran Info -->
            @if(!$tahunAjaran)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Perhatian!</strong>
                    <span class="block sm:inline">Tidak ada tahun ajaran aktif saat ini. Menampilkan semua kelas yang pernah Anda ajar.</span>
                </div>
            @else
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Tahun Ajaran:</strong>
                    <span class="inline">{{ $tahunAjaran->nama }}</span> |
                    <strong class="font-bold">Semester:</strong>
                    <span class="inline">{{ $tahunAjaran->semester }}</span>
                </div>
            @endif

            <!-- Kelas Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Mahasiswa</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tahun Ajaran</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas as $index => $k)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->nama_kelas }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->mataKuliah->sks }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->student_count }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $k->tahun_ajaran }} ({{ $k->semester }})</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('nilai.show', $k->id) }}"
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                            Input Nilai
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">Tidak ada kelas yang Anda ajar saat ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

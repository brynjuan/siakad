<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0l-6-3m6 3l6-3"/>
                </svg>
                {{ __('Transkrip Nilai Semester') }} 
                <span class="ml-2 bg-red-100 text-red-700 px-2 py-1 rounded text-base font-semibold">
                    {{ ucfirst($request->semester) }} {{ $request->tahun_ajaran }}
                </span>
            </h2>
            <a href="{{ route('transkrip.index') }}" class="bg-gradient-to-r from-red-600 to-red-400 hover:from-red-700 hover:to-red-500 text-white font-bold py-2 px-5 rounded-full shadow-lg transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-white to-red-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Info Card -->
            <div class="bg-white overflow-hidden shadow-xl rounded-xl border-l-8 border-red-500 mb-8">
                <div class="p-8 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.755 6.879 2.047M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Nama:
                            </span>
                            <span class="text-lg">{{ $mahasiswa->user->name }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"/>
                                </svg>
                                NIM:
                            </span>
                            <span class="text-lg">{{ $mahasiswa->nim }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0l-6-3m6 3l6-3"/>
                                </svg>
                                Program Studi:
                            </span>
                            <span class="text-lg">{{ $mahasiswa->prodi->nama_prodi }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Semester:
                            </span>
                            <span class="text-lg">{{ ucfirst($request->semester) }} {{ $request->tahun_ajaran }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mata Kuliah Table -->
            <div class="bg-white overflow-hidden shadow-xl rounded-xl border-l-8 border-red-500 mb-8">
                <div class="p-8 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Nilai Angka</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-red-100 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Nilai Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mataKuliah as $index => $krs)
                                <tr class="hover:bg-red-50 transition">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center font-semibold">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <span class="inline-block bg-red-100 text-red-700 px-2 py-1 rounded font-bold">{{ $krs->kelas->mataKuliah->sks }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded font-bold">{{ $krs->nilai->nilai_angka }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded font-bold">{{ $krs->nilai->nilai_huruf }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center text-gray-500">Tidak ada data nilai untuk semester ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="bg-red-100">
                                    <td colspan="3" class="px-6 py-4 font-semibold text-right border-b border-gray-200 text-red-700">Total SKS:</td>
                                    <td class="px-6 py-4 font-semibold border-b border-gray-200 text-center text-lg text-red-700">{{ $totalSksSemester }}</td>
                                    <td colspan="2" class="px-6 py-4 border-b border-gray-200"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- IP Semester Card -->
            <div class="bg-gradient-to-r from-red-100 to-white overflow-hidden shadow-xl rounded-xl border-l-8 border-red-500">
                <div class="p-8 text-gray-900 flex flex-col md:flex-row items-center justify-between gap-4">
                    <h3 class="text-xl font-bold flex items-center gap-2 text-red-700">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4"/>
                        </svg>
                        Indeks Prestasi Semester:
                    </h3>
                    <div class="bg-white text-red-700 rounded-xl px-10 py-5 text-3xl font-extrabold border-4 border-red-200 shadow-lg tracking-wider">
                        {{ number_format($ipSemester, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

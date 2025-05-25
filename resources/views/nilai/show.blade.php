<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-red-700 leading-tight tracking-wide drop-shadow-sm flex items-center gap-2">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"></path>
                </svg>
                {{ __('Input Nilai Mahasiswa') }}
            </h2>
            <a href="{{ route('nilai.index') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-2 px-4 rounded-md shadow-lg transition-all duration-200 ease-in-out flex items-center gap-2 border border-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-white to-red-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md animate-pulse" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="w-6 h-6 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Sukses!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-md animate-pulse" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="w-6 h-6 mr-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Error!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Class Info Card -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border-t-8 border-red-600 mb-8 hover:shadow-2xl transition-all duration-200">
                <div class="p-8 bg-white">
                    <h3 class="text-xl font-bold text-red-700 mb-4 pb-2 border-b-2 border-red-100 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Informasi Kelas
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Mata Kuliah:</p>
                                <p class="font-semibold text-gray-800">{{ $kelas->mataKuliah->nama_mk }} <span class="text-gray-500">({{ $kelas->mataKuliah->kode_mk }})</span></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Kelas:</p>
                                <p class="font-semibold text-gray-800">{{ $kelas->nama_kelas }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">SKS:</p>
                                <p class="font-semibold text-gray-800">{{ $kelas->mataKuliah->sks }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Tahun Ajaran:</p>
                                <p class="font-semibold text-gray-800">{{ $kelas->tahun_ajaran }} <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700 ml-2 shadow">{{ $kelas->semester }}</span></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Jumlah Mahasiswa:</p>
                                <p class="font-semibold text-gray-800">{{ $students->count() }} orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konversi Nilai Info -->
            <div class="bg-gradient-to-r from-red-100 to-white overflow-hidden shadow-md rounded-xl mb-8 border border-red-200">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-red-700 mb-3 pb-2 border-b border-gray-200 flex items-center gap-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Konversi Nilai
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        @php
                            $grades = [
                                ['A', '85-100', 'bg-green-100 text-green-800'],
                                ['A-', '80-84', 'bg-blue-100 text-blue-800'],
                                ['B+', '75-79', 'bg-blue-100 text-blue-800'],
                                ['B', '70-74', 'bg-blue-100 text-blue-800'],
                                ['B-', '65-69', 'bg-yellow-100 text-yellow-800'],
                                ['C+', '60-64', 'bg-yellow-100 text-yellow-800'],
                                ['C', '55-59', 'bg-yellow-100 text-yellow-800'],
                                ['C-', '50-54', 'bg-red-100 text-red-800'],
                                ['D', '40-49', 'bg-red-100 text-red-800'],
                                ['E', '0-39', 'bg-red-200 text-red-900'],
                            ];
                        @endphp
                        @foreach($grades as [$huruf, $range, $color])
                        <div class="rounded-md p-2 text-center shadow-sm border border-gray-100 hover:scale-105 transition-transform duration-150 {{ $color }}">
                            <span class="font-bold text-lg">{{ $huruf }}</span>
                            <span class="text-xs block">{{ $range }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Input Nilai Form -->
            <form action="{{ route('nilai.update', $kelas->id) }}" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-red-200">
                    <div class="px-6 py-4 border-b border-red-200 bg-gradient-to-r from-red-600 to-red-700 rounded-t-xl">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Input Nilai Mahasiswa
                        </h3>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-red-50">
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">NIM</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Nama Mahasiswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Nilai Angka</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Nilai Huruf</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($students as $index => $student)
                                    <tr class="hover:bg-red-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-semibold">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $student->mahasiswa->nim }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $student->mahasiswa->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" name="nilai[{{ $student->id }}]"
                                                   value="{{ old('nilai.'.$student->id, $student->nilai->nilai_angka ?? '') }}"
                                                   class="w-24 rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 shadow-sm transition-all duration-150"
                                                   min="0" max="100" step="0.01"
                                                   onchange="updateNilaiHuruf(this)">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span id="huruf-{{ $student->id }}" class="px-2.5 py-1.5 rounded-full text-xs font-bold shadow-sm transition-all duration-150
                                                {{ isset($student->nilai->nilai_huruf) ?
                                                ($student->nilai->nilai_huruf == 'A' ? 'bg-green-100 text-green-800' :
                                                ($student->nilai->nilai_huruf == 'B' || $student->nilai->nilai_huruf == 'B+' || $student->nilai->nilai_huruf == 'A-' ? 'bg-blue-100 text-blue-800' :
                                                ($student->nilai->nilai_huruf == 'C' || $student->nilai->nilai_huruf == 'C+' || $student->nilai->nilai_huruf == 'B-' ? 'bg-yellow-100 text-yellow-800' :
                                                'bg-red-100 text-red-800'))) : 'bg-gray-100 text-gray-800' }}">
                                                {{ $student->nilai->nilai_huruf ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="keterangan[{{ $student->id }}]"
                                                   value="{{ old('keterangan.'.$student->id, $student->nilai->keterangan ?? '') }}"
                                                   class="w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 shadow-sm transition-all duration-150">
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Tidak ada mahasiswa yang terdaftar di kelas ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($students->count() > 0)
                        <div class="mt-8 text-right">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-2 px-8 rounded-md shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan Nilai
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateNilaiHuruf(input) {
            const value = parseFloat(input.value);
            const krsId = input.name.match(/\[(\d+)\]/)[1];
            const hurufElement = document.getElementById('huruf-' + krsId);

            let huruf = '-';
            let bgClass = 'bg-gray-100 text-gray-800';

            if (!isNaN(value)) {
                if (value >= 85) {
                    huruf = 'A';
                    bgClass = 'bg-green-100 text-green-800';
                }
                else if (value >= 80) {
                    huruf = 'A-';
                    bgClass = 'bg-blue-100 text-blue-800';
                }
                else if (value >= 75) {
                    huruf = 'B+';
                    bgClass = 'bg-blue-100 text-blue-800';
                }
                else if (value >= 70) {
                    huruf = 'B';
                    bgClass = 'bg-blue-100 text-blue-800';
                }
                else if (value >= 65) {
                    huruf = 'B-';
                    bgClass = 'bg-yellow-100 text-yellow-800';
                }
                else if (value >= 60) {
                    huruf = 'C+';
                    bgClass = 'bg-yellow-100 text-yellow-800';
                }
                else if (value >= 55) {
                    huruf = 'C';
                    bgClass = 'bg-yellow-100 text-yellow-800';
                }
                else if (value >= 50) {
                    huruf = 'C-';
                    bgClass = 'bg-red-100 text-red-800';
                }
                else if (value >= 40) {
                    huruf = 'D';
                    bgClass = 'bg-red-100 text-red-800';
                }
                else {
                    huruf = 'E';
                    bgClass = 'bg-red-100 text-red-800';
                }
            }

            // Remove all existing background classes
            hurufElement.className = hurufElement.className
                .replace(/bg-\w+-\d+ text-\w+-\d+/g, '')
                .trim() + ' px-2.5 py-1.5 rounded-full text-xs font-medium ' + bgClass;

            hurufElement.textContent = huruf;
        }
    </script>
</x-app-layout>

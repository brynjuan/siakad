<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengisian Nilai Mahasiswa') }}
            </h2>
            <div class="flex space-x-2">
                <span class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 text-sm font-medium rounded-full">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Semester Aktif
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="w-6 h-6 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
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

            <!-- Tahun Ajaran Info Card -->
            @if(!$tahunAjaran)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-full">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Perhatian!</h3>
                            <div class="text-sm text-yellow-700">Tidak ada tahun ajaran aktif saat ini. Menampilkan semua kelas yang pernah Anda ajar.</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-r from-red-50 to-white border border-red-100 rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-red-100 rounded-full">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Informasi Akademik</h3>
                            <div class="text-sm text-red-700">
                                <span class="font-semibold">Tahun Ajaran:</span> {{ $tahunAjaran->nama }} |
                                <span class="font-semibold">Semester:</span> {{ $tahunAjaran->semester }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-red-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">Total Kelas</h2>
                                <p class="text-2xl font-bold text-gray-800">{{ $kelas->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-blue-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">Total Mahasiswa</h2>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $kelas->sum('student_count') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-green-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">Nilai Terisi</h2>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ \App\Models\Nilai::whereHas('krs.kelas', function($query) {
                                        $query->where('dosen_id', Auth::user()->dosen->id);
                                    })->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-yellow-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">Nilai Pending</h2>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ \App\Models\Krs::whereHas('kelas', function($query) {
                                        $query->where('dosen_id', Auth::user()->dosen->id);
                                    })->whereDoesntHave('nilai')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelas Table -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-t-4 border-red-600">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Daftar Kelas Mata Kuliah
                    </h3>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-red-50">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Kode MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">SKS</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Jumlah Mahasiswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Tahun Ajaran</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($kelas as $index => $k)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $k->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $k->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $k->nama_kelas }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $k->mataKuliah->sks }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $k->student_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $k->tahun_ajaran }}
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            {{ $k->semester }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $totalStudents = $k->student_count;
                                            $gradedCount = \App\Models\Krs::where('kelas_id', $k->id)
                                                ->whereHas('nilai')
                                                ->count();
                                            $percentage = $totalStudents > 0 ? ($gradedCount / $totalStudents) * 100 : 0;
                                        @endphp

                                        <div class="flex items-center justify-center">
                                            <div class="relative w-24 bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-{{ $percentage == 100 ? 'green' : ($percentage > 50 ? 'blue' : 'yellow') }}-600 h-2.5 rounded-full"
                                                    style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="ml-2 text-xs">{{ number_format($percentage, 0) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('nilai.show', $k->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Input Nilai
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-8 whitespace-nowrap border-b border-gray-200 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                            <span class="text-gray-500 font-medium">Tidak ada kelas yang Anda ajar saat ini.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hover effects for cards */
        .shadow-sm {
            transition: all 0.3s ease;
        }
        .shadow-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Progress bar animation */
        @keyframes progress {
            0% { width: 0; }
        }
        .bg-green-600, .bg-blue-600, .bg-yellow-600 {
            animation: progress 1s ease-out;
        }
    </style>
</x-app-layout>

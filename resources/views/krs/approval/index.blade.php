<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Persetujuan KRS Mahasiswa Bimbingan') }}
            </h2>
            <div class="flex space-x-2">
                <span class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 text-sm font-medium rounded-full">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Dosen Wali
                </span>
                <a href="{{ route('dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
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

            <!-- Tahun Ajaran Info -->
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
                            <div class="text-sm text-yellow-700">Tidak ada tahun ajaran aktif saat ini.</div>
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
                            <h3 class="text-sm font-medium text-red-800">Informasi Akademik:</h3>
                            <div class="text-sm text-red-700">
                                <span class="font-semibold">Tahun Ajaran:</span> {{ $tahunAjaran->nama }} |
                                <span class="font-semibold">Semester:</span> {{ $tahunAjaran->semester }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-red-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">Total Mahasiswa Bimbingan</h2>
                                <p class="text-2xl font-bold text-gray-800">{{ $mahasiswas->count() }}</p>
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
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">KRS Menunggu Persetujuan</h2>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $mahasiswas->where('krs_status', 'pending')->count() }}
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
                                <h2 class="font-semibold text-gray-600 text-sm uppercase tracking-wider">KRS Disetujui</h2>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ $mahasiswas->where('krs_status', 'disetujui')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mahasiswa Table -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-t-4 border-red-600">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Daftar Mahasiswa Bimbingan
                    </h3>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-red-50">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">NIM</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Nama Mahasiswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Program Studi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Status KRS</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Jumlah MK</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($mahasiswas as $index => $mahasiswa)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $mahasiswa->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $mahasiswa->prodi->nama_prodi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = 'bg-gray-100 text-gray-800';
                                            $statusLabel = 'Belum Mengisi';

                                            if ($mahasiswa->krs_status === 'pending') {
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                                $statusLabel = 'Menunggu Persetujuan';
                                            } elseif ($mahasiswa->krs_status === 'disetujui') {
                                                $statusClass = 'bg-green-100 text-green-800';
                                                $statusLabel = 'Disetujui';
                                            } elseif ($mahasiswa->krs_status === 'ditolak') {
                                                $statusClass = 'bg-red-100 text-red-800';
                                                $statusLabel = 'Ditolak';
                                            }
                                        @endphp

                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $mahasiswa->krs_count > 0 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $mahasiswa->krs_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        @if($mahasiswa->krs_count > 0)
                                            <a href="{{ route('krs.approval.show', $mahasiswa->id) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors mr-2">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat KRS
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-200 text-gray-500 text-sm font-medium rounded-md cursor-not-allowed">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                </svg>
                                                Belum Ada KRS
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 whitespace-nowrap text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-gray-500 font-medium">Tidak ada mahasiswa bimbingan.</span>
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
    </style>
</x-app-layout>

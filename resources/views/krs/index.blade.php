<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-red-700 leading-tight tracking-wide drop-shadow">
                {{ __('Kartu Rencana Studi') }}
            </h2>
            <a href="{{ route('krs.create') }}" class="px-5 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-600 hover:to-red-700 text-white font-bold rounded-lg shadow-lg transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                {{ __('Tambah KRS') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-red-50 via-white to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <!-- Total SKS Card -->
                <div class="bg-white overflow-hidden shadow-xl rounded-xl border-l-8 border-red-400 hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-gradient-to-br from-red-200 to-pink-200 text-red-700 shadow">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h2 class="text-lg font-semibold text-gray-700">Total SKS</h2>
                                <p class="text-3xl font-extrabold text-red-600 drop-shadow">{{ $totalSks ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status KRS Card -->
                <div class="bg-white overflow-hidden shadow-xl rounded-xl border-l-8 border-green-400 hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-gradient-to-br from-green-200 to-lime-200 text-green-700 shadow">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h2 class="text-lg font-semibold text-gray-700">Status KRS</h2>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                        Periode Aktif
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Batas pengisian: <span class="font-semibold text-red-500">30 Jan 2024</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Semester Card -->
                <div class="bg-white overflow-hidden shadow-xl rounded-xl border-l-8 border-pink-400 hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-gradient-to-br from-pink-200 to-red-100 text-pink-700 shadow">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h2 class="text-lg font-semibold text-gray-700">Semester Aktif</h2>
                                <p class="text-md font-bold text-pink-700">Ganjil 2023/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-2xl rounded-xl border border-red-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-100 to-pink-100">
                    <h3 class="text-lg font-bold text-red-800 tracking-wide">Daftar Mata Kuliah Yang Diambil</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow">
                            <thead class="bg-gradient-to-r from-gray-100 to-red-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kode MK</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Mata Kuliah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">SKS</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kelas</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Dosen</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                {{-- Loop through KRS List --}}
                                @forelse($krs ?? [] as $list)
                                <tr class="hover:bg-red-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $list->kelas->mataKuliah->kode_mk?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $list->kelas->mataKuliah->nama_mk ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $list->kelas->matakuliah->sks ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $list->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $list->kelas->dosen->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($list->status === 'disetujui')
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                                Disetujui
                                            </span>
                                        @elseif($list->status === 'pending')
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path></svg>
                                                Pending
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800 gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada mata kuliah yang diambil</td>
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

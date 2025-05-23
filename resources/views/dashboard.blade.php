<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Greeting Card -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8 text-white">
                    <div class="flex items-center">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                            <p class="text-red-100">
                                @if(Auth::user()->role === 'mahasiswa')
                                    Mahasiswa {{ Auth::user()->mahasiswa->prodi->nama_prodi ?? '' }}
                                @elseif(Auth::user()->role === 'dosen')
                                    Dosen {{ Auth::user()->dosen->gelar ?? '' }}
                                @else
                                    Administrator Sistem
                                @endif
                            </p>
                        </div>
                        <div class="ml-auto">
                            <svg class="w-32 h-32 text-red-300 opacity-25" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Role Based Content -->
            @if(Auth::user()->role === 'mahasiswa')
                <!-- Mahasiswa Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- KRS Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('krs.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Kartu Rencana Studi</h2>
                                    <p class="text-gray-500 text-sm">Atur dan kelola KRS semester aktif</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Jadwal Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('jadwal.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Jadwal Kuliah</h2>
                                    <p class="text-gray-500 text-sm">Lihat jadwal perkuliahan Anda</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Transkrip Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('transkrip.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Transkrip Nilai</h2>
                                    <p class="text-gray-500 text-sm">Lihat transkrip dan nilai Anda</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'dosen')
                <!-- Dosen Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Input Nilai Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('nilai.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Input Nilai</h2>
                                    <p class="text-gray-500 text-sm">Kelola nilai mahasiswa</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Persetujuan KRS Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('krs.approval.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Persetujuan KRS</h2>
                                    <p class="text-gray-500 text-sm">Verifikasi KRS mahasiswa bimbingan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Pengumuman Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-bold text-red-800">Pengumuman Terbaru</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="border-l-4 border-red-500 pl-4 py-2">
                            <h4 class="font-semibold text-gray-800">Jadwal UAS Semester Ganjil 2023/2024</h4>
                            <p class="text-sm text-gray-600 mt-1">Jadwal UAS semester ganjil 2023/2024 telah terbit. Silahkan cek di menu Jadwal.</p>
                            <span class="text-xs text-gray-500 mt-2 block">15 Desember 2023</span>
                        </div>
                        <div class="border-l-4 border-red-500 pl-4 py-2">
                            <h4 class="font-semibold text-gray-800">Pengisian KRS Semester Genap</h4>
                            <p class="text-sm text-gray-600 mt-1">Pengisian KRS semester genap akan dibuka pada tanggal 15-30 Januari 2024.</p>
                            <span class="text-xs text-gray-500 mt-2 block">10 Desember 2023</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

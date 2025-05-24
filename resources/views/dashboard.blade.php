<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Welcome Banner -->
            <div class="bg-gradient-to-r from-red-700 to-red-800 overflow-hidden shadow-xl sm:rounded-lg mb-8 transform transition duration-300 hover:shadow-2xl">
                <div class="p-8 text-white relative overflow-hidden">
                    <!-- Background pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="currentColor" fill-rule="evenodd"></path>
                            <path d="M0,0 L100,100 M100,0 L0,100" stroke="currentColor" stroke-width="1" fill="none"></path>
                        </svg>
                    </div>

                    <div class="flex items-center relative z-10">
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold mb-3 text-white">Selamat Datang, {{ Auth::user()->name }}!</h1>
                            <p class="text-red-100 text-lg">
                                @if(Auth::user()->role === 'mahasiswa')
                                    Mahasiswa {{ Auth::user()->mahasiswa->prodi->nama_prodi ?? '' }}
                                @elseif(Auth::user()->role === 'dosen')
                                    Dosen {{ Auth::user()->dosen->gelar ?? '' }}
                                @else
                                    Administrator Sistem
                                @endif
                            </p>
                            <div class="mt-4 bg-white bg-opacity-20 px-3 py-1 rounded-full inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm">{{ date('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-36 h-36 text-white opacity-20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Role Based Content -->
            @if(Auth::user()->role === 'mahasiswa')
                <!-- Mahasiswa Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
                    <!-- KRS Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 hover:border-red-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('krs.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-50 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Kartu Rencana Studi</h2>
                                    <p class="text-gray-600 text-sm">Atur dan kelola KRS semester aktif</p>
                                </div>
                                <div class="text-red-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Transkrip Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 hover:border-red-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('transkrip.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-50 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Transkrip Nilai</h2>
                                    <p class="text-gray-600 text-sm">Lihat transkrip dan nilai Anda</p>
                                </div>
                                <div class="text-red-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'dosen')
                <!-- Dosen Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Input Nilai Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 hover:border-red-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('nilai.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-50 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Input Nilai Mahasiswa</h2>
                                    <p class="text-gray-600 text-sm">Masukkan dan kelola nilai mahasiswa untuk mata kuliah yang Anda ajar</p>
                                </div>
                                <div class="text-red-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- KRS Approval Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 hover:border-red-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('krs.approval.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-50 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Persetujuan KRS</h2>
                                    <p class="text-gray-600 text-sm">Tinjau dan setujui KRS mahasiswa bimbingan Anda</p>
                                </div>
                                <div class="text-red-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Statistics for Dosen -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Mahasiswa Bimbingan Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 border-b border-red-100 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-600 uppercase tracking-wider">Mahasiswa Bimbingan</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Mahasiswa::where('dosen_wali_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas Mengajar Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 border-b border-red-100 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-600 uppercase tracking-wider">Kelas Mengajar</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Kelas::where('dosen_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- KRS Pending Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 border-b border-red-100 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-600 uppercase tracking-wider">KRS Menunggu</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Krs::whereHas('mahasiswa', function($query) {
                                        $query->where('dosen_wali_id', Auth::user()->dosen->id);
                                    })->where('status', 'pending')->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai Belum Diisi Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 border-b border-red-100 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-600 uppercase tracking-wider">Nilai Belum Diisi</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Krs::whereHas('kelas', function($query) {
                                        $query->where('dosen_id', Auth::user()->dosen->id);
                                    })->whereDoesntHave('nilai')->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(Auth::user()->role === 'admin')
                <!-- Admin Dashboard -->
                <div class="grid grid-cols-1  gap-6 mb-8">
                    <!-- Mahasiswa Management Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 hover:border-red-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <a href="{{ route('mahasiswa.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-50 text-red-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Kelola Data Mahasiswa</h2>
                                    <p class="text-gray-600 text-sm">Tambah, edit, dan hapus data mahasiswa</p>
                                </div>
                                <div class="text-red-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Visi & Misi Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 transition duration-300 hover:shadow-lg">
                <div class="px-6 py-4 bg-gradient-to-r from-red-700 to-red-800 text-white">
                    <h2 class="text-lg font-bold">VISI & MISI UNIVERSITAS TADULAKO</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="bg-red-50 rounded-lg p-5 border-l-4 border-red-600">
                        <h3 class="text-lg font-semibold text-red-800 mb-2">Visi</h3>
                        <p class="text-gray-700 italic">
                            "Universitas Tadulako Menjadi Perguruan Tinggi Berstandar International
                            Dalam Pengembangan IPTEKS Berwawasan Lingkungan Hidup"
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-red-800 mb-3">Misi</h3>
                        <ol class="list-decimal list-inside space-y-3 text-gray-700">
                            <li class="pl-2">Menyelenggarakan pendidikan yang bermutu, modern, dan relevan menuju pencapaian standar internasional dalam pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                            <li class="pl-2">Menyelenggarakan penelitian yang bermutu untuk pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                            <li class="pl-2">Menyelenggarakan pengabdian kepada masyarakat sebagai perwujudan hasil pendidikan dan hasil penelitian yang dibutuhkan dalam pembangunan masyarakat.</li>
                            <li class="pl-2">Menyelenggarakan reformasi birokrasi dan kerjasama regional, nasional dan internasional.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Tutorial Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 transition duration-300 hover:shadow-lg">
                <div class="px-6 py-4 bg-gradient-to-r from-red-700 to-red-800 text-white">
                    <h2 class="text-lg font-bold">TUTORIAL PENGGUNAAN SIAKAD</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-red-50 rounded-lg p-4 text-center">
                        <p class="text-gray-800 font-semibold text-lg">
                            Mahasiswa Harus Mandiri Ber KRS<br>
                            <span class="text-red-600">Say no to GAPTEK</span>
                        </p>
                    </div>

                    <div class="mt-4 border-l-4 border-red-600 pl-4 py-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Cara Reset Password</h3>
                        <div class="flex items-center space-x-2 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">SIAKAD2UNTAD Rubah Password User</span>
                            <span class="text-sm bg-red-100 px-2 py-1 rounded-full">Watch on Rubia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengumuman Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 transition duration-300 hover:shadow-lg">
                <div class="px-6 py-4 bg-gradient-to-r from-red-700 to-red-800 text-white">
                    <h3 class="text-lg font-bold flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Pengumuman Terbaru
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-600 hover:bg-red-100 transition duration-300">
                            <h4 class="font-semibold text-red-800">Jadwal UAS Semester Ganjil 2023/2024</h4>
                            <p class="text-sm text-gray-700 mt-2">Jadwal UAS semester ganjil 2023/2024 telah terbit. Silahkan cek di menu Jadwal.</p>
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                15 Desember 2023
                            </div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-600 hover:bg-red-100 transition duration-300">
                            <h4 class="font-semibold text-red-800">Pengisian KRS Semester Genap</h4>
                            <p class="text-sm text-gray-700 mt-2">Pengisian KRS semester genap akan dibuka pada tanggal 15-30 Januari 2024.</p>
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                10 Desember 2023
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

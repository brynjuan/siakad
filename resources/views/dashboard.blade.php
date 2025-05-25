<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <svg class="h-8 w-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <h2 class="font-bold text-2xl text-gray-900 leading-tight tracking-wide">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="relative bg-white border-2 border-red-300 rounded-2xl shadow-lg mb-10 overflow-hidden">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-b from-red-100 to-white opacity-40"></div>
                <div class="p-8 flex flex-col md:flex-row items-center relative z-10">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-red-500 drop-shadow">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-700 text-base md:text-lg mb-2">
                            @if(Auth::user()->role === 'mahasiswa')
                                <span class="font-semibold text-red-400">Mahasiswa</span> {{ Auth::user()->mahasiswa->prodi->nama_prodi ?? '' }}
                            @elseif(Auth::user()->role === 'dosen')
                                <span class="font-semibold text-red-400">Dosen</span> {{ Auth::user()->dosen->gelar ?? '' }}
                            @else
                                <span class="font-semibold text-red-400">Administrator Sistem</span>
                            @endif
                        </p>
                        <div class="inline-flex items-center bg-red-100 px-4 py-1 rounded-full shadow text-red-500 font-medium">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ date('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="hidden md:block ml-8">
                        <svg class="w-32 h-32 text-red-50" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="10" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- User Role Based Content -->
            @if(Auth::user()->role === 'mahasiswa')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- KRS Card -->
                    <div class="bg-white border-2 border-red-200 rounded-xl shadow hover:shadow-xl transition hover:scale-105">
                        <a href="{{ route('krs.index') }}" class="block p-7">
                            <div class="flex items-center">
                                <div class="p-4 rounded-full bg-red-100 text-red-400 shadow">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 flex-1">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Kartu Rencana Studi</h2>
                                    <p class="text-gray-600 text-sm">Atur dan kelola KRS semester aktif</p>
                                </div>
                                <div class="text-red-400">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Transkrip Card -->
                    <div class="bg-white border-2 border-red-200 rounded-xl shadow hover:shadow-xl transition hover:scale-105">
                        <a href="{{ route('transkrip.index') }}" class="block p-7">
                            <div class="flex items-center">
                                <div class="p-4 rounded-full bg-red-100 text-red-400 shadow">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 flex-1">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Transkrip Nilai</h2>
                                    <p class="text-gray-600 text-sm">Lihat transkrip dan nilai Anda</p>
                                </div>
                                <div class="text-red-400">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'dosen')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Input Nilai Card -->
                    <div class="bg-white border-2 border-red-200 rounded-xl shadow hover:shadow-xl transition hover:scale-105">
                        <a href="{{ route('nilai.index') }}" class="block p-7">
                            <div class="flex items-center">
                                <div class="p-4 rounded-full bg-red-100 text-red-400 shadow">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </div>
                                <div class="ml-5 flex-1">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Input Nilai Mahasiswa</h2>
                                    <p class="text-gray-600 text-sm">Masukkan dan kelola nilai mahasiswa untuk mata kuliah yang Anda ajar</p>
                                </div>
                                <div class="text-red-400">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- KRS Approval Card -->
                    <div class="bg-white border-2 border-red-200 rounded-xl shadow hover:shadow-xl transition hover:scale-105">
                        <a href="{{ route('krs.approval.index') }}" class="block p-7">
                            <div class="flex items-center">
                                <div class="p-4 rounded-full bg-red-100 text-red-400 shadow">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 flex-1">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Persetujuan KRS</h2>
                                    <p class="text-gray-600 text-sm">Tinjau dan setujui KRS mahasiswa bimbingan Anda</p>
                                </div>
                                <div class="text-red-400">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Statistics for Dosen -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <!-- Mahasiswa Bimbingan Card -->
                    <div class="bg-white border-2 border-red-100 rounded-xl shadow hover:shadow-lg transition hover:scale-105">
                        <div class="p-6 border-b border-red-50 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-400 uppercase tracking-wider">Mahasiswa Bimbingan</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Mahasiswa::where('dosen_wali_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas Mengajar Card -->
                    <div class="bg-white border-2 border-red-100 rounded-xl shadow hover:shadow-lg transition hover:scale-105">
                        <div class="p-6 border-b border-red-50 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-400 uppercase tracking-wider">Kelas Mengajar</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Kelas::where('dosen_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- KRS Pending Card -->
                    <div class="bg-white border-2 border-red-100 rounded-xl shadow hover:shadow-lg transition hover:scale-105">
                        <div class="p-6 border-b border-red-50 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-400 uppercase tracking-wider">KRS Menunggu</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Krs::whereHas('mahasiswa', function($query) {
                                        $query->where('dosen_wali_id', Auth::user()->dosen->id);
                                    })->where('status', 'pending')->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai Belum Diisi Card -->
                    <div class="bg-white border-2 border-red-100 rounded-xl shadow hover:shadow-lg transition hover:scale-105">
                        <div class="p-6 border-b border-red-50 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-red-400 uppercase tracking-wider">Nilai Belum Diisi</p>
                                <p class="text-3xl font-bold text-gray-800 mt-1">
                                    {{ App\Models\Krs::whereHas('kelas', function($query) {
                                        $query->where('dosen_id', Auth::user()->dosen->id);
                                    })->whereDoesntHave('nilai')->count() }}
                                </p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-full">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'admin')
                <div class="grid grid-cols-1 gap-8 mb-10">
                    <!-- Mahasiswa Management Card -->
                    <div class="bg-white border-2 border-red-200 rounded-xl shadow hover:shadow-xl transition hover:scale-105">
                        <a href="{{ route('mahasiswa.index') }}" class="block p-7">
                            <div class="flex items-center">
                                <div class="p-4 rounded-full bg-red-100 text-red-400 shadow">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 flex-1">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Kelola Data Mahasiswa</h2>
                                    <p class="text-gray-600 text-sm">Tambah, edit, dan hapus data mahasiswa</p>
                                </div>
                                <div class="text-red-400">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Profil & Tujuan Section -->
            <div class="bg-white border-2 border-red-300 rounded-xl shadow-md overflow-hidden mb-10 hover:shadow-xl transition">
                <div class="flex items-center px-6 py-4 bg-gradient-to-r from-red-400 to-red-500 text-white">
                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 7v9"></path>
                    </svg>
                    <h2 class="text-lg font-bold">PROFIL & TUJUAN UNIVERSITAS TADULAKO</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="bg-red-50 rounded-lg p-5 border-l-4 border-red-300">
                        <h3 class="text-lg font-semibold text-red-500 mb-2">Visi</h3>
                        <p class="text-gray-700 italic">
                            "Menjadi universitas unggul, inovatif, dan berdaya saing global dalam pengembangan ilmu pengetahuan, teknologi, dan lingkungan."
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-500 mb-3">Misi</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>Menyelenggarakan pendidikan berkualitas berbasis teknologi dan karakter.</li>
                            <li>Menghasilkan riset inovatif yang berdampak pada kemajuan masyarakat dan lingkungan.</li>
                            <li>Menguatkan pengabdian kepada masyarakat melalui kolaborasi dan solusi nyata.</li>
                            <li>Membangun tata kelola universitas yang adaptif, transparan, dan berorientasi global.</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-500 mb-3">Nilai-Nilai Utama</h3>
                        <div class="flex flex-wrap gap-4">
                            <span class="bg-red-50 text-red-500 px-4 py-1 rounded-full font-medium">Integritas</span>
                            <span class="bg-red-50 text-red-500 px-4 py-1 rounded-full font-medium">Inovasi</span>
                            <span class="bg-red-50 text-red-500 px-4 py-1 rounded-full font-medium">Kolaborasi</span>
                            <span class="bg-red-50 text-red-500 px-4 py-1 rounded-full font-medium">Keberlanjutan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tutorial Section -->
            <div class="bg-white border-2 border-red-300 rounded-xl shadow-md overflow-hidden mb-10 hover:shadow-xl transition">
                <div class="flex items-center px-6 py-4 bg-gradient-to-r from-red-400 to-red-500 text-white">
                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h.01M12 12h.01M9 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-lg font-bold">PANDUAN SINGKAT SIAKAD</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-red-50 rounded-lg p-4 text-center border-l-4 border-red-300">
                        <p class="text-gray-800 font-semibold text-lg">
                            Gunakan SIAKAD secara mandiri dan bertanggung jawab.<br>
                            <span class="text-red-500">Jadilah Mahasiswa Digital!</span>
                        </p>
                    </div>
                    <div class="mt-4 border-l-4 border-red-300 pl-4 py-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Reset Password Akun</h3>
                        <div class="flex items-center space-x-2 text-red-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Menu Profil &gt; Ubah Password</span>
                            <span class="text-sm bg-red-100 px-2 py-1 rounded-full">Lihat Panduan Video</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-2">Jika lupa password, hubungi admin fakultas untuk reset manual.</p>
                    </div>
                </div>
            </div>

            <!-- Pengumuman Card -->
            <div class="bg-white border-2 border-red-300 rounded-xl shadow-md overflow-hidden mb-10 hover:shadow-xl transition">
                <div class="flex items-center px-6 py-4 bg-gradient-to-r from-red-400 to-red-500 text-white">
                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <h3 class="text-lg font-bold">Info & Pengumuman</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-300 hover:bg-red-100 transition">
                            <h4 class="font-semibold text-red-500">Perkuliahan Semester Genap 2023/2024 Dimulai</h4>
                            <p class="text-sm text-gray-700 mt-2">Perkuliahan semester genap dimulai 5 Februari 2024. Pastikan KRS Anda sudah disetujui dosen wali.</p>
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                2 Februari 2024
                            </div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-300 hover:bg-red-100 transition">
                            <h4 class="font-semibold text-red-500">Update Fitur SIAKAD</h4>
                            <p class="text-sm text-gray-700 mt-2">Kini Anda dapat mengunduh Kartu Hasil Studi (KHS) langsung dari menu Transkrip.</p>
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                25 Januari 2024
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

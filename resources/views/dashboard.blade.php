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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
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
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('nilai.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Input Nilai Mahasiswa</h2>
                                    <p class="text-gray-500 text-sm">Masukkan dan kelola nilai mahasiswa untuk mata kuliah yang Anda ajar</p>
                                </div>
                                <div class="ml-auto text-blue-500">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- KRS Approval Card -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                        <a href="{{ route('krs.approval.index') }}" class="block p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-700">Persetujuan KRS</h2>
                                    <p class="text-gray-500 text-sm">Tinjau dan setujui KRS mahasiswa bimbingan Anda</p>
                                </div>
                                <div class="ml-auto text-green-500">
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
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Mahasiswa Bimbingan</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ App\Models\Mahasiswa::where('dosen_wali_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas Mengajar Card -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Kelas Mengajar</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ App\Models\Kelas::where('dosen_id', Auth::user()->dosen->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- KRS Pending Card -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">KRS Menunggu</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ App\Models\Krs::whereHas('mahasiswa', function($query) {
                                        $query->where('dosen_wali_id', Auth::user()->dosen->id);
                                    })->where('status', 'pending')->count() }}
                                </p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai Belum Diisi Card -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Nilai Belum Diisi</p>
                                <p class="text-2xl font-bold text-gray-800">
                                    {{ App\Models\Krs::whereHas('kelas', function($query) {
                                        $query->where('dosen_id', Auth::user()->dosen->id);
                                    })->whereDoesntHave('nilai')->count() }}
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Visi & Misi Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h2 class="text-lg font-bold text-red-800">VISI & MISI UNIVERSITAS TADULAKO</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Visi</h3>
                        <p class="text-gray-600 italic">
                            "Universitas Tadulako Menjadi Perguruan Tinggi Berstandar International
                            Dalam Pengembangan IPTEKS Berwawasan Lingkungan Hidup"
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Misi</h3>
                        <ol class="list-decimal list-inside space-y-2 text-gray-600">
                            <li>Menyelenggarakan pendidikan yang bermutu, modern, dan relevan menuju pencapaian standar internasional dalam pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                            <li>Menyelenggarakan penelitian yang bermutu untuk pengembangan IPTEKS berwawasan lingkungan hidup.</li>
                            <li>Menyelenggarakan pengabdian kepada masyarakat sebagai perwujudan hasil pendidikan dan hasil penelitian yang dibutuhkan dalam pembangunan masyarakat.</li>
                            <li>Menyelenggarakan reformasi birokrasi dan kerjasama regional, nasional dan internasional.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Tutorial Section -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h2 class="text-lg font-bold text-red-800">TUTORIAL PENGGUNAAN SIAKAD</h2>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-gray-600 font-semibold">
                        Mahasiswa Harus Mandiri Ber KRS<br>
                        Say no to GAPTEK
                    </p>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Cara Reset Password</h3>
                        <div class="flex items-center space-x-2 text-red-600">
                            <span class="font-medium">SIAKAD2UNTAD Rubah Password User</span>
                            <span class="text-sm">▼️ Watch on Rubia</span>
                        </div>
                    </div>
                </div>
            </div>


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

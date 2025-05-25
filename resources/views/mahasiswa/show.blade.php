<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-red-800 leading-tight tracking-wide drop-shadow-md">
                {{ __('Detail Mahasiswa') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('mahasiswa.index') }}" class="bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-bold py-2 px-4 rounded-md flex items-center transition duration-300 shadow-md hover:scale-105">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white font-bold py-2 px-4 rounded-md flex items-center transition duration-300 shadow-md hover:scale-105">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-red-50 via-white to-red-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Info Card -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl mb-8 border-2 border-red-200 hover:shadow-2xl transition duration-300">
                <!-- Header Strip -->
                <div class="bg-gradient-to-r from-red-700 to-red-800 py-5 px-8 text-white flex items-center justify-between rounded-t-2xl">
                    <h3 class="text-xl font-bold tracking-wide flex items-center gap-2">
                        <svg class="w-6 h-6 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Mahasiswa
                    </h3>
                    <div class="px-4 py-1 bg-white bg-opacity-30 rounded-full text-sm font-semibold shadow-inner border border-white/30">
                        <span class="tracking-widest text-red-900">{{ $mahasiswa->nim }}</span>
                    </div>
                </div>

                <div class="p-8 text-gray-900">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="w-full md:w-1/3 flex flex-col items-center justify-start mb-6 md:mb-0">
                            <div class="w-36 h-36 rounded-full bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white text-5xl font-extrabold mb-5 shadow-lg border-4 border-white">
                                {{ substr($mahasiswa->user->name, 0, 1) }}
                            </div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center drop-shadow-sm">{{ $mahasiswa->user->name }}</h1>

                            <div class="px-5 py-1 text-base rounded-full font-semibold shadow-md mt-2
                                {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-800 border border-green-300' :
                                  ($mahasiswa->status === 'cuti' ? 'bg-yellow-100 text-yellow-800 border border-yellow-300' :
                                  ($mahasiswa->status === 'lulus' ? 'bg-blue-100 text-blue-800 border border-blue-300' : 'bg-red-100 text-red-800 border border-red-300')) }}">
                                <span class="uppercase tracking-wider">{{ ucfirst($mahasiswa->status) }}</span>
                            </div>
                        </div>

                        <div class="w-full md:w-2/3 md:pl-8">
                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 pb-2 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Data Pribadi
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Email</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->user->email }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Tempat, Tanggal Lahir</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Jenis Kelamin</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Alamat</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->alamat }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-100 pb-2 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Data Akademik
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Jurusan</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->jurusan->nama_jurusan }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Program Studi</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->prodi->nama_prodi }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Angkatan</p>
                                        <p class="font-semibold text-gray-800">{{ $mahasiswa->angkatan }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:bg-red-50 transition">
                                        <p class="text-xs text-red-600 font-semibold uppercase">Dosen Wali</p>
                                        <p class="font-semibold text-gray-800">
                                            @if(isset($mahasiswa->dosenWali))
                                                {{ $mahasiswa->dosenWali->user->name ?? 'Belum ditentukan' }}
                                            @else
                                                Belum ditentukan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Total SKS Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform transition duration-300 hover:shadow-2xl hover:-translate-y-1 border-2 border-red-200">
                    <div class="p-8 text-gray-900 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-red-600 uppercase font-bold tracking-wider">Total SKS</p>
                                <p class="text-4xl font-extrabold text-gray-800 mt-2">{{ $mahasiswa->total_sks ?? 0 }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-100 to-red-300 p-4 rounded-full text-red-700 shadow">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- IPK Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform transition duration-300 hover:shadow-2xl hover:-translate-y-1 border-2 border-red-200">
                    <div class="p-8 text-gray-900 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-red-600 uppercase font-bold tracking-wider">IPK</p>
                                <p class="text-4xl font-extrabold text-gray-800 mt-2">{{ number_format($mahasiswa->ipk ?? 0, 2) }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-100 to-red-300 p-4 rounded-full text-red-700 shadow">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Semester Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform transition duration-300 hover:shadow-2xl hover:-translate-y-1 border-2 border-red-200">
                    <div class="p-8 text-gray-900 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-red-600 uppercase font-bold tracking-wider">Semester</p>
                                <p class="text-4xl font-extrabold text-gray-800 mt-2">{{ $mahasiswa->current_semester ?? '-' }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-100 to-red-300 p-4 rounded-full text-red-700 shadow">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MK Diambil Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform transition duration-300 hover:shadow-2xl hover:-translate-y-1 border-2 border-red-200">
                    <div class="p-8 text-gray-900 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-red-600 uppercase font-bold tracking-wider">MK Diambil</p>
                                <p class="text-4xl font-extrabold text-gray-800 mt-2">{{ $mahasiswa->total_mata_kuliah ?? 0 }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-100 to-red-300 p-4 rounded-full text-red-700 shadow">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

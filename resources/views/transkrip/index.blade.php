<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-red-400 to-pink-500 px-6 py-4 rounded-t-lg shadow">
            <h2 class="font-semibold text-xl text-white leading-tight flex items-center gap-2">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 6a9 9 0 110-18 9 9 0 010 18z"/>
                </svg>
                {{ __('Transkrip Nilai') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-red-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Student Info Card -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-8 border-red-400 mb-8 transition-transform hover:scale-105 duration-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Informasi Mahasiswa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-semibold">Nama:</span>
                            <span class="ml-1 text-red-700">{{ $mahasiswa->user->name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">NIM:</span>
                            <span class="ml-1 text-red-700">{{ $mahasiswa->nim }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Program Studi:</span>
                            <span class="ml-1 text-red-700">{{ $mahasiswa->prodi->nama_prodi }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Jurusan:</span>
                            <span class="ml-1 text-red-700">{{ $mahasiswa->jurusan->nama_jurusan }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Total SKS:</span>
                            <span class="ml-1 text-red-700">{{ $totalSks }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">IPK:</span>
                            <span class="ml-1 text-red-700 font-bold">{{ number_format($ipk, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semester Selection -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-8 border-pink-400 mb-8 transition-transform hover:scale-105 duration-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V7c0-2.21 3.582-4 8-4s8 1.79 8 4v7c0 2.21-3.582 4-8 4z"/>
                        </svg>
                        Pilih Semester
                    </h3>

                    @if($semesters->isEmpty())
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative shadow" role="alert">
                            <span class="block sm:inline">Belum ada data nilai yang tersedia.</span>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($semesters as $semester)
                                <form action="{{ route('transkrip.show') }}" method="GET" class="transition-transform hover:scale-105 duration-200">
                                    <input type="hidden" name="tahun_ajaran" value="{{ $semester->tahun_ajaran }}">
                                    <input type="hidden" name="semester" value="{{ $semester->semester }}">
                                    <button type="submit" class="w-full bg-gradient-to-r from-pink-100 to-red-100 hover:from-pink-200 hover:to-red-200 text-red-800 font-semibold py-4 px-4 rounded-xl border border-red-200 shadow flex flex-col items-center gap-1 transition">
                                        <div class="text-lg font-bold flex items-center gap-2">
                                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m0-5V3m-8 4v10a4 4 0 004 4h4"/>
                                            </svg>
                                            {{ ucfirst($semester->semester) }}
                                        </div>
                                        <div class="text-sm">{{ $semester->tahun_ajaran }}</div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- IPK Summary Card -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-8 border-red-400 transition-transform hover:scale-105 duration-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m4 0h-1V8h-1m-4 0h-1v4h-1m4 0h-1v4h-1"/>
                        </svg>
                        Indeks Prestasi Kumulatif (IPK)
                    </h3>
                    <div class="flex justify-center">
                        <div class="bg-gradient-to-br from-red-100 to-pink-100 text-red-800 rounded-full w-36 h-36 flex items-center justify-center border-8 border-red-200 shadow-lg relative">
                            <div class="text-center">
                                <div class="text-4xl font-extrabold">{{ number_format($ipk, 2) }}</div>
                                <div class="text-xs mt-1 text-gray-500">dari 4.00</div>
                            </div>
                            <span class="absolute top-2 right-2 bg-red-400 text-white text-xs px-3 py-1 rounded-full shadow">
                                {{ $ipk >= 3.51 ? 'Dengan Pujian' : ($ipk >= 3.01 ? 'Sangat Memuaskan' : ($ipk >= 2.76 ? 'Memuaskan' : 'Cukup')) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-medium mb-2">Keterangan Indeks Prestasi:</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                            <div class="py-1 px-2 rounded bg-red-50 border border-red-100 shadow-sm">3.51 - 4.00 = Dengan Pujian</div>
                            <div class="py-1 px-2 rounded bg-red-50 border border-red-100 shadow-sm">3.01 - 3.50 = Sangat Memuaskan</div>
                            <div class="py-1 px-2 rounded bg-red-50 border border-red-100 shadow-sm">2.76 - 3.00 = Memuaskan</div>
                            <div class="py-1 px-2 rounded bg-red-50 border border-red-100 shadow-sm">&lt; 2.76 = Cukup</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

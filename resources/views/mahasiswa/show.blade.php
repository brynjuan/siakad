<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Mahasiswa') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 flex flex-col items-center justify-start mb-6 md:mb-0">
                            <div class="w-32 h-32 rounded-full bg-indigo-600 flex items-center justify-center text-white text-4xl font-bold mb-4">
                                {{ substr($mahasiswa->user->name, 0, 1) }}
                            </div>
                            <h1 class="text-xl font-bold text-gray-800 mb-2">{{ $mahasiswa->user->name }}</h1>
                            <div class="px-4 py-1 text-sm rounded-full bg-gray-200 text-gray-800 mb-2">
                                {{ $mahasiswa->nim }}
                            </div>
                            <div class="px-4 py-1 text-sm rounded-full
                                {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-800' :
                                  ($mahasiswa->status === 'cuti' ? 'bg-yellow-100 text-yellow-800' :
                                  ($mahasiswa->status === 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($mahasiswa->status) }}
                            </div>
                        </div>

                        <div class="w-full md:w-2/3 md:pl-6">
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-indigo-600 border-b border-gray-200 pb-2 mb-3">
                                    Data Pribadi
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-medium">{{ $mahasiswa->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                                        <p class="font-medium">{{ $mahasiswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                        <p class="font-medium">{{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500">Alamat</p>
                                        <p class="font-medium">{{ $mahasiswa->alamat }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-indigo-600 border-b border-gray-200 pb-2 mb-3">
                                    Data Akademik
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Jurusan</p>
                                        <p class="font-medium">{{ $mahasiswa->jurusan->nama_jurusan }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Program Studi</p>
                                        <p class="font-medium">{{ $mahasiswa->prodi->nama_prodi }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Angkatan</p>
                                        <p class="font-medium">{{ $mahasiswa->angkatan }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Dosen Wali</p>
                                        <p class="font-medium">
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-l-4 border-indigo-500 h-full">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Total SKS</p>
                                <p class="text-2xl font-bold">{{ $mahasiswa->total_sks ?? 0 }}</p>
                            </div>
                            <div class="text-indigo-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-l-4 border-green-500 h-full">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">IPK</p>
                                <p class="text-2xl font-bold">{{ number_format($mahasiswa->ipk ?? 0, 2) }}</p>
                            </div>
                            <div class="text-green-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-l-4 border-blue-500 h-full">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">Semester</p>
                                <p class="text-2xl font-bold">{{ $mahasiswa->current_semester ?? '-' }}</p>
                            </div>
                            <div class="text-blue-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-l-4 border-yellow-500 h-full">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 uppercase">MK Diambil</p>
                                <p class="text-2xl font-bold">{{ $mahasiswa->total_mata_kuliah ?? 0 }}</p>
                            </div>
                            <div class="text-yellow-500">
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

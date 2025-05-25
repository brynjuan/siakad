<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-wide drop-shadow-sm">
                {{ __('Data Mahasiswa') }}
            </h2>
            <a href="{{ route('mahasiswa.create') }}" class="bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-bold py-2 px-5 rounded-lg shadow-lg transition-all duration-300 flex items-center gap-2 ring-2 ring-red-200 hover:ring-red-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Tambah Mahasiswa</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-white via-red-50 to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <!-- Search & Filter Section -->
                <div class="p-6 bg-gradient-to-r from-red-50 to-pink-50 border-b border-gray-200">
                    <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-grow">
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM..." class="focus:ring-pink-500 focus:border-pink-500 block w-full pl-10 pr-4 py-2 sm:text-sm border-gray-300 rounded-lg bg-white/80 transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-48">
                            <select name="status" class="focus:ring-pink-500 focus:border-pink-500 block w-full py-2 px-3 border border-gray-300 bg-white/80 rounded-lg shadow-sm sm:text-sm transition-all duration-200">
                                <option value="">Status Mahasiswa</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="cuti" {{ request('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="drop out" {{ request('status') == 'drop out' ? 'selected' : '' }}>Drop Out</option>
                            </select>
                        </div>
                        <div class="w-full md:w-48">
                            <select name="jurusan" class="focus:ring-pink-500 focus:border-pink-500 block w-full py-2 px-3 border border-gray-300 bg-white/80 rounded-lg shadow-sm sm:text-sm transition-all duration-200">
                                <option value="">Semua Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-pink-600 to-red-600 hover:from-pink-700 hover:to-red-700 text-white py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center justify-center gap-2 ring-1 ring-pink-200 hover:ring-pink-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span>Filter</span>
                        </button>
                    </form>
                </div>

                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-md shadow flex items-center animate-fade-in" role="alert">
                            <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <span class="font-bold">Berhasil!</span>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                            <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none';">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-md shadow flex items-center animate-fade-in" role="alert">
                            <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <span class="font-bold">Error!</span>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                            <button type="button" class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.style.display='none';">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-xl shadow-lg ring-1 ring-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-red-700 to-pink-700 sticky top-0 z-10 shadow">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">NIM</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Jurusan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Program Studi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Angkatan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($mahasiswas as $index => $mahasiswa)
                                <tr class="hover:bg-pink-50/60 transition-all duration-150 group">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswas->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 tracking-wide">{{ $mahasiswa->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $mahasiswa->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswa->prodi->nama_prodi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center text-pink-700">{{ $mahasiswa->angkatan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'aktif' => 'bg-green-200/80 text-green-900 border-green-300 shadow',
                                                'cuti' => 'bg-yellow-200/80 text-yellow-900 border-yellow-300 shadow',
                                                'lulus' => 'bg-blue-200/80 text-blue-900 border-blue-300 shadow',
                                                'drop out' => 'bg-red-200/80 text-red-900 border-red-300 shadow'
                                            ];
                                            $statusClass = $statusClasses[$mahasiswa->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        <span class="px-4 py-1 inline-flex text-xs leading-5 font-bold rounded-full border {{ $statusClass }} ring-1 ring-inset ring-white/40">
                                            {{ ucfirst($mahasiswa->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="text-blue-600 hover:text-white hover:bg-blue-500 rounded-full p-2 transition-all duration-200 shadow group-hover:scale-110" title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="text-yellow-600 hover:text-white hover:bg-yellow-500 rounded-full p-2 transition-all duration-200 shadow group-hover:scale-110" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-white hover:bg-red-500 rounded-full p-2 transition-all duration-200 shadow group-hover:scale-110" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-gray-500 bg-gray-50 italic">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2">Tidak ada data mahasiswa ditemukan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-center">
                        {{ $mahasiswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Animasi fade-in untuk alert */
        .animate-fade-in { animation: fadeIn 0.7s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px);} to { opacity: 1; transform: none;} }
    </style>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Mahasiswa') }}
            </h2>
            <a href="{{ route('mahasiswa.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Mahasiswa
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <!-- Search & Filter Section -->
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-grow">
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM..." class="focus:ring-red-500 focus:border-red-500 block w-full pl-10 pr-4 py-2 sm:text-sm border-gray-300 rounded-md">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-48">
                            <select name="status" class="focus:ring-red-500 focus:border-red-500 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm sm:text-sm">
                                <option value="">Status Mahasiswa</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="cuti" {{ request('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="drop out" {{ request('status') == 'drop out' ? 'selected' : '' }}>Drop Out</option>
                            </select>
                        </div>
                        <div class="w-full md:w-48">
                            <select name="jurusan" class="focus:ring-red-500 focus:border-red-500 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm sm:text-sm">
                                <option value="">Semua Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>
                    </form>
                </div>

                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-md shadow-sm flex items-center" role="alert">
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
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-md shadow-sm flex items-center" role="alert">
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

                    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-red-700 to-red-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">NIM</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jurusan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Program Studi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Angkatan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($mahasiswas as $index => $mahasiswa)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswas->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $mahasiswa->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $mahasiswa->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mahasiswa->prodi->nama_prodi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">{{ $mahasiswa->angkatan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'aktif' => 'bg-green-100 text-green-800 border-green-200',
                                                'cuti' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'lulus' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'drop out' => 'bg-red-100 text-red-800 border-red-200'
                                            ];
                                            $statusClass = $statusClasses[$mahasiswa->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClass }}">
                                            {{ ucfirst($mahasiswa->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-full p-1 transition duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="text-yellow-600 hover:text-yellow-900 hover:bg-yellow-50 rounded-full p-1 transition duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 hover:bg-red-50 rounded-full p-1 transition duration-200" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
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

                    <div class="mt-6">
                        {{ $mahasiswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

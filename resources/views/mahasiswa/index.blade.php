<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Mahasiswa') }}
            </h2>
            <a href="{{ route('mahasiswa.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Mahasiswa
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIM</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jurusan</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Program Studi</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Angkatan</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswas as $index => $mahasiswa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswas->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->nim }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->prodi->nama_prodi }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->angkatan }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-800' :
                                                   ($mahasiswa->status === 'cuti' ? 'bg-yellow-100 text-yellow-800' :
                                                   ($mahasiswa->status === 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($mahasiswa->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                            <a href="{{ route('mahasiswa.show', $mahasiswa) }}" class="text-blue-600 hover:text-blue-900 mr-2">Detail</a>
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center" colspan="8">Tidak ada data mahasiswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $mahasiswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

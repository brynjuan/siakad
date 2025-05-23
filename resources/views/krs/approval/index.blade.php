<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar KRS Mahasiswa Bimbingan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
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

            <!-- Tahun Ajaran Info -->
            @if(!$tahunAjaran)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Perhatian!</strong>
                    <span class="block sm:inline">Tidak ada tahun ajaran aktif saat ini.</span>
                </div>
            @else
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Tahun Ajaran:</strong>
                    <span class="inline">{{ $tahunAjaran->nama }}</span> |
                    <strong class="font-bold">Semester:</strong>
                    <span class="inline">{{ $tahunAjaran->semester }}</span>
                </div>
            @endif

            <!-- Mahasiswa Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIM</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Mahasiswa</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Program Studi</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status KRS</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah MK</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswas as $index => $mahasiswa)
                                <tr>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->nim }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->prodi->nama_prodi }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $mahasiswa->krs_status == 'approved' ? 'bg-green-100 text-green-800' :
                                               ($mahasiswa->krs_status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                               ($mahasiswa->krs_status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $mahasiswa->krs_status == 'belum_mengisi' ? 'Belum Mengisi' :
                                               ($mahasiswa->krs_status == 'pending' ? 'Menunggu Persetujuan' :
                                               ($mahasiswa->krs_status == 'disetujui' ? 'Disetujui' : 'Ditolak')) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $mahasiswa->krs_count }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        @if($mahasiswa->krs_count > 0)
                                            <a href="{{ route('krs.approval.show', $mahasiswa->id) }}"
                                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                Lihat KRS
                                            </a>
                                        @else
                                            <button disabled
                                                    class="bg-gray-300 text-gray-500 font-bold py-1 px-3 rounded text-xs cursor-not-allowed">
                                                Belum Ada KRS
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">Tidak ada mahasiswa bimbingan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

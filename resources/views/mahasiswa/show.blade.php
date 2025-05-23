<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Mahasiswa') }}
            </h2>
            <div>
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="border rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>

                            <div class="mb-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->user->name) }}&background=random&size=128"
                                    alt="{{ $mahasiswa->user->name }}" class="rounded-full mb-4 mx-auto">
                            </div>

                            <table class="min-w-full">
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Nama</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">NIM</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->nim }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Email</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Jenis Kelamin</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Tempat, Tgl Lahir</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Alamat</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->alamat }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Academic Information -->
                        <div class="border rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akademik</h3>

                            <table class="min-w-full">
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Jurusan</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->jurusan->nama_jurusan }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Program Studi</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->prodi->nama_prodi }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Angkatan</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->angkatan }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Status</td>
                                    <td class="py-2 text-sm">
                                        : <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-800' :
                                          ($mahasiswa->status === 'cuti' ? 'bg-yellow-100 text-yellow-800' :
                                          ($mahasiswa->status === 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ ucfirst($mahasiswa->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-sm font-medium text-gray-500">Terdaftar Sejak</td>
                                    <td class="py-2 text-sm text-gray-900">: {{ $mahasiswa->created_at->format('d F Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- KRS Information (if available) -->
                    @if($mahasiswa->krs->isNotEmpty())
                    <div class="mt-6 border rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Riwayat KRS</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Ajaran</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($mahasiswa->krs as $krs)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $krs->tahun_ajaran }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $krs->semester }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $krs->kelas->nama_kelas }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $krs->kelas->mataKuliah->sks }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $krs->status === 'disetujui' ? 'bg-green-100 text-green-800' :
                                                  ($krs->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($krs->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

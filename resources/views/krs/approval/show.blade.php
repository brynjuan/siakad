<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail KRS Mahasiswa') }}
            </h2>
            <a href="{{ route('krs.approval.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
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

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Mahasiswa Info Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-blue-500 text-white px-4 py-3 font-semibold">
                        Informasi Mahasiswa
                    </div>
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full">
                            <tr>
                                <td class="py-2 font-semibold w-1/3">Nama</td>
                                <td class="py-2 w-2/3">{{ $mahasiswa->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">NIM</td>
                                <td class="py-2">{{ $mahasiswa->nim }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Program Studi</td>
                                <td class="py-2">{{ $mahasiswa->prodi->nama_prodi }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- KRS Info Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-blue-500 text-white px-4 py-3 font-semibold">
                        Informasi KRS
                    </div>
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full">
                            <tr>
                                <td class="py-2 font-semibold w-1/3">Tahun Ajaran</td>
                                <td class="py-2 w-2/3">{{ $tahunAjaran->nama }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Semester</td>
                                <td class="py-2">{{ $tahunAjaran->semester }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Total SKS</td>
                                <td class="py-2">{{ $totalSks }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Status</td>
                                <td class="py-2">

                                    @if($krs->isEmpty())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">

                                        Belum Mengisi
                                    </span>
                                    @elseif($krs->first()->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Persetujuan
                                    </span>
                                    @elseif($krs->first()->status == 'disetujui')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                    @elseif($krs->first()->status == 'ditolak')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- KRS Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dosen</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jadwal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($krs as $index => $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->kelas->mataKuliah->sks }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->kelas->nama_kelas }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->kelas->dosen->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        @if($item->kelas->jadwal->isEmpty())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Belum Ada Jadwal
                                            </span>
                                        @else
                                            @foreach($item->kelas->jadwal as $jadwal)
                                                <div class="mb-1 last:mb-0">
                                                    {{ $jadwal->hari }},
                                                    {{ $jadwal->jam_mulai->format('H:i') }} -
                                                    {{ $jadwal->jam_selesai->format('H:i') }},
                                                    {{ $jadwal->ruang }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">Mahasiswa belum mengisi KRS.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Approval Buttons -->
                    @if(!$krs->isEmpty() && $krs->first()->status == 'pending')
                    <div class="mt-6 flex justify-center gap-4">
                        <form action="{{ route('krs.approval.approve', $mahasiswa->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Anda yakin ingin menyetujui KRS ini?')">
                                Setujui KRS
                            </button>
                        </form>
                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="openRejectModal()">
                            Tolak KRS
                        </button>
                    </div>
                    @elseif(!$krs->isEmpty() && $krs->first()->status == 'ditolak')
                    <div class="mt-6">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Alasan Penolakan:</strong>
                            <span class="block sm:inline">{{ $krs->first()->keterangan }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('krs.approval.reject', $mahasiswa->id) }}" method="POST">
                    @csrf
                    <div class="bg-red-600 px-4 py-3 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                            Tolak KRS
                        </h3>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700">Alasan Penolakan <span class="text-red-500">*</span></label>
                            <textarea id="alasan_penolakan" name="alasan_penolakan" rows="3"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    required></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Tolak KRS
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                onclick="closeRejectModal()">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

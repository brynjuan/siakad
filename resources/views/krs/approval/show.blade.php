<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail KRS Mahasiswa') }}
            </h2>
            <a href="{{ route('krs.approval.index') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="w-6 h-6 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="w-6 h-6 mr-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Error!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Student & KRS Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Mahasiswa Info Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg border-t-4 border-red-600">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Mahasiswa
                        </h3>
                    </div>
                    <div class="p-6 bg-white">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-red-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                                {{ substr($mahasiswa->user->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $mahasiswa->user->name }}</h4>
                                <span class="text-sm text-gray-600">{{ $mahasiswa->nim }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Program Studi</div>
                                <div class="w-2/3 text-sm font-semibold text-gray-800">{{ $mahasiswa->prodi->nama_prodi }}</div>
                            </div>
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Jurusan</div>
                                <div class="w-2/3 text-sm font-semibold text-gray-800">{{ $mahasiswa->jurusan->nama_jurusan }}</div>
                            </div>
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Angkatan</div>
                                <div class="w-2/3 text-sm font-semibold text-gray-800">{{ $mahasiswa->angkatan }}</div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Status</div>
                                <div class="w-2/3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($mahasiswa->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KRS Info Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg border-t-4 border-red-600">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Informasi KRS
                        </h3>
                    </div>
                    <div class="p-6 bg-white">
                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Tahun Ajaran</div>
                                <div class="w-2/3 text-sm font-semibold text-gray-800">{{ $tahunAjaran->nama }}</div>
                            </div>
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Semester</div>
                                <div class="w-2/3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        {{ ucfirst($tahunAjaran->semester) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex border-b pb-2">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Total SKS</div>
                                <div class="w-2/3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $totalSks }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Status</div>
                                <div class="w-2/3">
                                    @if($krs->isEmpty())
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                            Belum Mengisi
                                        </span>
                                    @elseif($krs->first()->status == 'pending')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                                            Menunggu Persetujuan
                                        </span>
                                    @elseif($krs->first()->status == 'disetujui')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    @elseif($krs->first()->status == 'ditolak')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KRS Table -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-t-4 border-red-600 mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Daftar Mata Kuliah
                    </h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-red-50">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Kode MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">SKS</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Dosen</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider border-b-2 border-red-200">Jadwal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($krs as $index => $item)
                                <tr class="hover:bg-red-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-medium">{{ $item->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $item->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $item->kelas->mataKuliah->sks }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $item->kelas->nama_kelas }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $item->kelas->dosen->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        @if($item->kelas->jadwal->isEmpty())
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                Belum Ada Jadwal
                                            </span>
                                        @else
                                            @foreach($item->kelas->jadwal as $jadwal)
                                                <div class="mb-1 last:mb-0">
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                        {{ $jadwal->hari }}, {{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}
                                                    </span>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                        {{ $jadwal->ruang }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 whitespace-nowrap border-b border-gray-200 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg class="w-12 h-12 text-red-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                            </svg>
                                            <span class="text-gray-500 font-medium">Mahasiswa belum mengisi KRS.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            @if(count($krs) > 0)
                            <tfoot>
                                <tr class="bg-red-50 font-semibold">
                                    <td colspan="3" class="px-6 py-3 text-right">Total SKS:</td>
                                    <td class="px-6 py-3">
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                            {{ $totalSks }}
                                        </span>
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Approval Actions -->
            @if(!$krs->isEmpty() && $krs->first()->status == 'pending')
            <div class="flex flex-col sm:flex-row justify-center gap-4 bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
                <form action="{{ route('krs.approval.approve', $mahasiswa->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md shadow-sm transition-colors flex items-center justify-center"
                            onclick="return confirm('Anda yakin ingin menyetujui KRS ini?')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Setujui KRS
                    </button>
                </form>
                <button type="button" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-md shadow-sm transition-colors flex items-center justify-center"
                        onclick="openRejectModal()">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tolak KRS
                </button>
            </div>
            @elseif(!$krs->isEmpty() && $krs->first()->status == 'ditolak')
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-600 mb-6">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="p-3 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-red-800">Alasan Penolakan KRS</h4>
                            <p class="mt-2 text-gray-600 bg-gray-50 p-3 rounded-md border border-gray-200">
                                {{ $krs->first()->keterangan ?: 'Tidak ada alasan yang diberikan.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @elseif(!$krs->isEmpty() && $krs->first()->status == 'disetujui')
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-green-600 mb-6">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-green-800">KRS Telah Disetujui</h4>
                            <p class="mt-2 text-gray-600">
                                KRS mahasiswa ini telah disetujui dan dapat digunakan untuk semester berjalan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak KRS
                            </div>
                        </h3>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                            <textarea id="alasan_penolakan" name="alasan_penolakan" rows="4"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                                    placeholder="Masukkan alasan penolakan KRS ini..."
                                    required></textarea>
                            <p class="mt-1 text-sm text-gray-500">Alasan ini akan ditampilkan kepada mahasiswa sebagai panduan untuk revisi KRS.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
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

    <style>
        /* Card hover and transition effects */
        .shadow-md {
            transition: all 0.3s ease;
        }
        .shadow-md:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Animated badge */
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        /* Modal transition */
        .transform {
            transition-property: transform, opacity;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pilih Mata Kuliah KRS') }}
            </h2>
            <a href="{{ route('krs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Student and Semester Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold">Detail Mahasiswa</h3>
                            <p>Nama: {{ $mahasiswa->user->name }}</p>
                            <p>NIM: {{ $mahasiswa->nim }}</p>
                            <p>Program Studi: {{ $mahasiswa->prodi->nama_prodi }}</p>
                            <p>Jurusan: {{ $mahasiswa->jurusan->nama_jurusan }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Semester Aktif</h3>
                            <p>Tahun Ajaran: {{ $tahunAjaran->nama }}</p>
                            <p>Semester: {{ $tahunAjaran->semester }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KRS Selection Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('krs.store') }}" id="krs-form">
                        @csrf

                        <p class="mb-4 text-sm text-gray-600">Silahkan pilih mata kuliah yang ingin Anda ambil pada semester ini:</p>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pilih</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode MK</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Mata Kuliah</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SKS</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dosen</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelas as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <input type="checkbox" name="kelas_ids[]" value="{{ $item->id }}"
                                                    class="kelas-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                                    {{ in_array($item->id, $selectedKelasIds) ? 'checked' : '' }}>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->mataKuliah->kode_mk }}</td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->mataKuliah->nama_mk }}</td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->mataKuliah->sks }}</td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->nama_kelas }}</td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->dosen->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                @forelse ($item->jadwal as $jadwal)
                                                    <div class="text-xs">{{ $jadwal->hari }}, {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }} ({{ $jadwal->ruang }})</div>
                                                @empty
                                                    <div class="text-xs text-gray-500">Belum ada jadwal</div>
                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center" colspan="7">Belum ada kelas yang tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div id="sks-counter" class="text-sm text-gray-600 mr-4 flex items-center">Total SKS: <span class="font-bold ml-1">0</span></div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan KRS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menghitung total SKS
            function updateTotalSks() {
                const checkboxes = document.querySelectorAll('.kelas-checkbox:checked');
                let totalSks = 0;

                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const sks = parseInt(row.cells[3].textContent);
                    totalSks += sks;
                });

                document.querySelector('#sks-counter span').textContent = totalSks;
            }

            // Update total SKS saat halaman dimuat
            updateTotalSks();

            // Update total SKS saat checkbox diubah
            document.querySelectorAll('.kelas-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalSks);
            });
        });
    </script>
</x-app-layout>

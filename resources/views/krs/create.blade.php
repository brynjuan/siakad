<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-red-500 via-pink-500 to-yellow-500 px-6 py-4 rounded-t-lg shadow-md">
            <h2 class="font-semibold text-xl text-white leading-tight flex items-center gap-2">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 0l-9-5m9 5l9-5" /></svg>
                {{ __('Pilih Mata Kuliah KRS') }}
            </h2>
            <a href="{{ route('krs.index') }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 hover:from-pink-700 hover:to-red-700 text-white font-semibold rounded-md shadow-lg transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-yellow-50 via-pink-50 to-red-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-md flex items-center gap-2" role="alert">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-1.414 1.414A9 9 0 105.636 18.364l1.414-1.414A7 7 0 1116.95 7.05z" /></svg>
                    <div>
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Student and Semester Info Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 border-l-8 border-red-400">
                <div class="p-6 text-gray-900 bg-gradient-to-r from-red-50 to-yellow-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-red-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Detail Mahasiswa
                            </h3>
                            <p>Nama: <span class="font-semibold">{{ $mahasiswa->user->name }}</span></p>
                            <p>NIM: <span class="font-semibold">{{ $mahasiswa->nim }}</span></p>
                            <p>Program Studi: <span class="font-semibold">{{ $mahasiswa->prodi->nama_prodi }}</span></p>
                            <p>Jurusan: <span class="font-semibold">{{ $mahasiswa->jurusan->nama_jurusan }}</span></p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-red-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Semester Aktif
                            </h3>
                            <p>Tahun Ajaran: <span class="font-semibold">{{ $tahunAjaran->nama }}</span></p>
                            <p>Semester: <span class="font-semibold">{{ $tahunAjaran->semester }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KRS Selection Form -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-8 border-pink-400">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-pink-100 to-yellow-100 flex items-center gap-2">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m2 0a8 8 0 11-16 0 8 8 0 0116 0z" /></svg>
                    <h3 class="text-lg font-bold text-red-800">Pilih Mata Kuliah</h3>
                </div>
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('krs.store') }}" id="krs-form">
                        @csrf

                        <p class="mb-4 text-sm text-gray-600 italic">Silahkan pilih mata kuliah yang ingin Anda ambil pada semester ini:</p>

                        <div class="overflow-x-auto rounded-lg shadow-inner">
                            <table class="min-w-full divide-y divide-gray-200 bg-gradient-to-br from-white via-pink-50 to-yellow-50 rounded-lg">
                                <thead class="bg-pink-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Pilih</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Kode MK</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Nama Mata Kuliah</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">SKS</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Kelas</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Dosen</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($kelas as $item)
                                        <tr class="hover:bg-pink-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" name="kelas_ids[]" value="{{ $item->id }}"
                                                    class="kelas-checkbox rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500 scale-125"
                                                    {{ in_array($item->id, $selectedKelasIds) ? 'checked' : '' }}>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ $item->mataKuliah->kode_mk }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->mataKuliah->nama_mk }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold text-pink-700">{{ $item->mataKuliah->sks }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_kelas }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->dosen->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @forelse ($item->jadwal as $jadwal)
                                                    <div class="text-xs bg-yellow-100 rounded px-2 py-1 mb-1 inline-block">
                                                        <span class="font-semibold text-yellow-700">{{ $jadwal->hari }}</span>,
                                                        {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                                        <span class="ml-1 text-pink-700">({{ $jadwal->ruang }})</span>
                                                    </div>
                                                @empty
                                                    <div class="text-xs text-gray-500 italic">Belum ada jadwal</div>
                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic" colspan="7">Belum ada kelas yang tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex flex-col sm:flex-row sm:justify-end sm:items-center gap-4">
                            <div id="sks-counter" class="text-sm text-pink-700 bg-pink-100 px-4 py-2 rounded shadow-inner flex items-center gap-2">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" /></svg>
                                Total SKS: <span class="font-bold ml-1">0</span>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-pink-600 to-red-600 hover:from-red-700 hover:to-pink-700 text-white font-bold py-2 px-6 rounded shadow-lg transition-all flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
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

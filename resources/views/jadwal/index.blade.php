<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Jadwal Kuliah') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-semibold">Nama:</span>
                            {{ $mahasiswa->user->name }}
                        </div>
                        <div>
                            <span class="font-semibold">NIM:</span>
                            {{ $mahasiswa->nim }}
                        </div>
                        <div>
                            <span class="font-semibold">Program Studi:</span>
                            {{ $mahasiswa->prodi->nama_prodi }}
                        </div>
                        <div>
                            <span class="font-semibold">Semester:</span>
                            {{ $tahunAjaran ? "{$tahunAjaran->nama} ({$tahunAjaran->semester})" : 'Tidak ada semester aktif' }}
                        </div>
                    </div>
                </div>
            </div>

            @if($krsEntries->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6" role="alert">
                <p class="font-bold">Tidak ada jadwal yang tersedia</p>
                <p class="text-sm">Anda belum mengambil mata kuliah atau belum ada jadwal yang terdaftar.</p>
            </div>
            @elseif($krsEntries->pluck('kelas.jadwal')->flatten()->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6" role="alert">
                <p class="font-bold">Jadwal belum tersedia</p>
                <p class="text-sm">Anda sudah mengambil mata kuliah, tetapi jadwal belum ditentukan.</p>
            </div>
            @else
                <!-- Weekly Schedule Display -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Jadwal Kuliah Mingguan</h3>

                        <!-- Day Tabs -->
                        <div class="mb-4">
                            <div class="sm:hidden">
                                <label for="daySelect" class="sr-only">Pilih Hari</label>
                                <select id="daySelect" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        onchange="showDay(this.value)">
                                    @foreach($weeklySchedule as $day => $schedules)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                        @foreach($weeklySchedule as $day => $schedules)
                                            <button type="button"
                                                    onclick="showDay('{{ $day }}')"
                                                    class="day-tab {{ $loop->first ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                                    data-day="{{ $day }}">
                                                {{ $day }}
                                            </button>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <!-- Day Schedules -->
                        @foreach($weeklySchedule as $day => $schedules)
                            <div id="schedule-{{ $day }}" class="day-schedule {{ $loop->first ? 'block' : 'hidden' }}">
                                @if(count($schedules) > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruang</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($schedules as $schedule)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $schedule['jam_mulai'] }} - {{ $schedule['jam_selesai'] }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            <div>{{ $schedule['mataKuliah'] }}</div>
                                                            <div class="text-xs text-gray-500">{{ $schedule['kode_mk'] }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $schedule['kelas'] }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $schedule['sks'] }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $schedule['dosen'] }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $schedule['ruang'] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-8 text-gray-500">
                                        <p>Tidak ada jadwal kuliah pada hari {{ $day }}.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function showDay(day) {
            // Hide all day schedules
            document.querySelectorAll('.day-schedule').forEach(el => {
                el.classList.add('hidden');
            });

            // Show selected day schedule
            document.getElementById('schedule-' + day).classList.remove('hidden');

            // Update tab styling
            document.querySelectorAll('.day-tab').forEach(el => {
                if (el.dataset.day === day) {
                    el.classList.add('border-indigo-500', 'text-indigo-600');
                    el.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                } else {
                    el.classList.remove('border-indigo-500', 'text-indigo-600');
                    el.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                }
            });

            // Update mobile dropdown
            document.getElementById('daySelect').value = day;
        }
    </script>
</x-app-layout>

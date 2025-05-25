<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transkrip Nilai') }}
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

            <!-- Student Info Card -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Informasi Mahasiswa</h3>
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
                            <span class="font-semibold">Jurusan:</span>
                            {{ $mahasiswa->jurusan->nama_jurusan }}
                        </div>
                        <div>
                            <span class="font-semibold">Total SKS:</span>
                            {{ $totalSks }}
                        </div>
                        <div>
                            <span class="font-semibold">IPK:</span>
                            {{ number_format($ipk, 2) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semester Selection -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500 mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Pilih Semester</h3>

                    @if($semesters->isEmpty())
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">Belum ada data nilai yang tersedia.</span>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($semesters as $semester)
                                <form action="{{ route('transkrip.show') }}" method="GET">
                                    <input type="hidden" name="tahun_ajaran" value="{{ $semester->tahun_ajaran }}">
                                    <input type="hidden" name="semester" value="{{ $semester->semester }}">
                                    <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-800 font-semibold py-3 px-4 rounded border border-red-200">
                                        <div class="text-lg">{{ ucfirst($semester->semester) }}</div>
                                        <div>{{ $semester->tahun_ajaran }}</div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- IPK Summary Card -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg border-l-4 border-red-500">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Indeks Prestasi Kumulatif (IPK)</h3>
                    <div class="flex justify-center">
                        <div class="bg-red-100 text-red-800 rounded-full w-32 h-32 flex items-center justify-center border-4 border-red-300">
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ number_format($ipk, 2) }}</div>
                                <div class="text-sm mt-1">dari 4.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-medium mb-2">Keterangan Indeks Prestasi:</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                            <div class="py-1 px-2 rounded bg-red-50">3.51 - 4.00 = Dengan Pujian</div>
                            <div class="py-1 px-2 rounded bg-red-50">3.01 - 3.50 = Sangat Memuaskan</div>
                            <div class="py-1 px-2 rounded bg-red-50">2.76 - 3.00 = Memuaskan</div>
                            <div class="py-1 px-2 rounded bg-red-50">< 2.76 = Cukup</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

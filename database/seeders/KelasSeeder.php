<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all mata kuliah
        $mataKuliahs = MataKuliah::all();

        if ($mataKuliahs->isEmpty()) {
            $this->command->info('No mata kuliah found. Please run the MataKuliahSeeder first.');
            return;
        }

        // Get all dosen
        $dosens = Dosen::all();

        if ($dosens->isEmpty()) {
            $this->command->info('No dosen found. Please run the DosenSeeder first.');
            return;
        }

        // Create a default tahun ajaran if none exists
        $tahunAjaran = TahunAjaran::firstOrCreate(
            ['status' => true],
            [
                'nama' => '2023/2024',
                'semester' => 'ganjil',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(6),
            ]
        );

        // Create classes for each mata kuliah
        $kelasCount = 0;
        foreach ($mataKuliahs as $mataKuliah) {
            // Create 1-3 classes for each mata kuliah
            $numClasses = rand(1, 3);

            for ($i = 0; $i < $numClasses; $i++) {
                $kelas = Kelas::create([
                    'mata_kuliah_id' => $mataKuliah->id,
                    'dosen_id' => $dosens->random()->id,
                    'nama_kelas' => chr(65 + $i), // A, B, C
                    'tahun_ajaran' => $tahunAjaran->nama,
                    'semester' => $tahunAjaran->semester,
                ]);

                $kelasCount++;
            }
        }

        $this->command->info("Created {$kelasCount} kelas records.");
    }
}

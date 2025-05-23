<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all prodi IDs
        $prodiIds = Prodi::pluck('id', 'nama_prodi')->toArray();

        // Mata kuliah for Teknik Informatika
        $mataKuliahTI = [
            ['kode_mk' => 'TI101', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI102', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI103', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 2, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI201', 'nama_mk' => 'Struktur Data', 'sks' => 4, 'semester' => 2, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI202', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 2, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI301', 'nama_mk' => 'Basis Data', 'sks' => 4, 'semester' => 3, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI302', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI401', 'nama_mk' => 'Pemrograman Web', 'sks' => 4, 'semester' => 4, 'tipe' => 'wajib'],
            ['kode_mk' => 'TI402', 'nama_mk' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 4, 'tipe' => 'wajib'],
        ];

        // Mata kuliah for Sistem Informasi
        $mataKuliahSI = [
            ['kode_mk' => 'SI101', 'nama_mk' => 'Pengantar Sistem Informasi', 'sks' => 3, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'SI102', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'SI201', 'nama_mk' => 'Basis Data', 'sks' => 4, 'semester' => 2, 'tipe' => 'wajib'],
            ['kode_mk' => 'SI202', 'nama_mk' => 'Analisis dan Desain Sistem', 'sks' => 3, 'semester' => 2, 'tipe' => 'wajib'],
            ['kode_mk' => 'SI301', 'nama_mk' => 'Sistem Enterprise', 'sks' => 3, 'semester' => 3, 'tipe' => 'wajib'],
            ['kode_mk' => 'SI302', 'nama_mk' => 'Pengembangan Aplikasi Web', 'sks' => 4, 'semester' => 3, 'tipe' => 'wajib'],
        ];

        // Insert mata kuliah with corresponding prodi_id
        foreach ($mataKuliahTI as $mk) {
            $prodiId = Prodi::where('nama_prodi', 'Teknik Informatika')->value('id');
            if ($prodiId) {
                DB::table('mata_kuliah')->insert(array_merge($mk, ['prodi_id' => $prodiId]));
            }
        }

        foreach ($mataKuliahSI as $mk) {
            $prodiId = Prodi::where('nama_prodi', 'Sistem Informasi')->value('id');
            if ($prodiId) {
                DB::table('mata_kuliah')->insert(array_merge($mk, ['prodi_id' => $prodiId]));
            }
        }

        // Add some mata kuliah for Teknik Komputer and Teknik Jaringan
        $mataKuliahTK = [
            ['kode_mk' => 'TK101', 'nama_mk' => 'Arsitektur Komputer', 'sks' => 3, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'TK201', 'nama_mk' => 'Mikrokontroler', 'sks' => 4, 'semester' => 2, 'tipe' => 'wajib'],
        ];

        $mataKuliahTJ = [
            ['kode_mk' => 'TJ101', 'nama_mk' => 'Pengantar Jaringan', 'sks' => 3, 'semester' => 1, 'tipe' => 'wajib'],
            ['kode_mk' => 'TJ201', 'nama_mk' => 'Administrasi Jaringan', 'sks' => 4, 'semester' => 2, 'tipe' => 'wajib'],
        ];

        foreach ($mataKuliahTK as $mk) {
            $prodiId = Prodi::where('nama_prodi', 'Teknik Komputer')->value('id');
            if ($prodiId) {
                DB::table('mata_kuliah')->insert(array_merge($mk, ['prodi_id' => $prodiId]));
            }
        }

        foreach ($mataKuliahTJ as $mk) {
            $prodiId = Prodi::where('nama_prodi', 'Teknik Jaringan')->value('id');
            if ($prodiId) {
                DB::table('mata_kuliah')->insert(array_merge($mk, ['prodi_id' => $prodiId]));
            }
        }
    }
}

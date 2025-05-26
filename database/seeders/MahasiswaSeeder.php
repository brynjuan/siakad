<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data referensi jurusan, prodi, dosen
        $jurusanIds = Jurusan::pluck('id')->toArray();
        $prodiIds = Prodi::pluck('id')->toArray();
        $dosenIds = Dosen::pluck('id')->toArray();

        // Data manual mahasiswa
        $mahasiswaData = [
            [
                'name' => 'Briant Juan Hamonangan',
                'email' => 'BriantJuanHamonangan@gmail.com',
                'nim' => 'F55123030',
                'tempat_lahir' => 'Tolitoli',
                'tanggal_lahir' => '2006-07-10',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Zebra Star',
                'jurusan_id' => $jurusanIds[0] ?? 1,
                'prodi_id' => $prodiIds[0] ?? 1,
                'angkatan' => 2023,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[0] ?? 1,
            ],
            [
                'name' => 'Fransisca Aprilia',
                'email' => 'fransisca.aprilia@untad.ac.id',
                'nim' => 'F55123026',
                'tempat_lahir' => 'Luwuk',
                'tanggal_lahir' => '2005-04-06',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pendidikan',
                'jurusan_id' => $jurusanIds[1] ?? 1,
                'prodi_id' => $prodiIds[1] ?? 1,
                'angkatan' => 2023,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[1] ?? 1,
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'nim' => '2019030003',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2001-03-10',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Diponegoro No.3 Surabaya',
                'jurusan_id' => $jurusanIds[2] ?? 1,
                'prodi_id' => $prodiIds[2] ?? 1,
                'angkatan' => 2019,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[2] ?? 1,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'nim' => '2020040004',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2002-07-12',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Malioboro No.4 Yogyakarta',
                'jurusan_id' => $jurusanIds[0] ?? 1,
                'prodi_id' => $prodiIds[0] ?? 1,
                'angkatan' => 2020,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[0] ?? 1,
            ],
            [
                'name' => 'Rizky Pratama',
                'email' => 'rizky.pratama@example.com',
                'nim' => '2021050005',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2003-09-25',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pandanaran No.5 Semarang',
                'jurusan_id' => $jurusanIds[1] ?? 1,
                'prodi_id' => $prodiIds[1] ?? 1,
                'angkatan' => 2021,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[1] ?? 1,
            ],
            [
                'name' => 'Putri Maharani',
                'email' => 'putri.maharani@example.com',
                'nim' => '2021060006',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2003-11-30',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Gatot Subroto No.6 Medan',
                'jurusan_id' => $jurusanIds[2] ?? 1,
                'prodi_id' => $prodiIds[2] ?? 1,
                'angkatan' => 2021,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[2] ?? 1,
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@example.com',
                'nim' => '2022070007',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '2004-02-18',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pettarani No.7 Makassar',
                'jurusan_id' => $jurusanIds[0] ?? 1,
                'prodi_id' => $prodiIds[0] ?? 1,
                'angkatan' => 2022,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[0] ?? 1,
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya.sari@example.com',
                'nim' => '2022080008',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2004-04-22',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Sudirman No.8 Palembang',
                'jurusan_id' => $jurusanIds[1] ?? 1,
                'prodi_id' => $prodiIds[1] ?? 1,
                'angkatan' => 2022,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[1] ?? 1,
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@example.com',
                'nim' => '2023090009',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2005-06-14',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Ijen No.9 Malang',
                'jurusan_id' => $jurusanIds[2] ?? 1,
                'prodi_id' => $prodiIds[2] ?? 1,
                'angkatan' => 2023,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[2] ?? 1,
            ],
            [
                'name' => 'Nina Agustin',
                'email' => 'nina.agustin@example.com',
                'nim' => '2023100010',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2005-08-19',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Diponegoro No.10 Denpasar',
                'jurusan_id' => $jurusanIds[0] ?? 1,
                'prodi_id' => $prodiIds[0] ?? 1,
                'angkatan' => 2023,
                'status' => 'aktif',
                'dosen_wali_id' => $dosenIds[0] ?? 1,
            ],
        ];

        foreach ($mahasiswaData as $data) {
            // Buat user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]);

            // Buat mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $data['nim'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'jurusan_id' => $data['jurusan_id'],
                'prodi_id' => $data['prodi_id'],
                'angkatan' => $data['angkatan'],
                'status' => $data['status'],
                'dosen_wali_id' => $data['dosen_wali_id'],
            ]);
        }
    }
}

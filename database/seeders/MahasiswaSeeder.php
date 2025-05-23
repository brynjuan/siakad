<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Get all jurusan and prodi IDs for reference
        $jurusanIds = Jurusan::pluck('id')->toArray();

        // Create 50 students
        for ($i = 0; $i < 50; $i++) {
            // Create user with role mahasiswa
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]);

            // Select a random jurusan
            $jurusanId = $faker->randomElement($jurusanIds);

            // Get prodi from the selected jurusan
            $prodiIdsForJurusan = Prodi::where('jurusan_id', $jurusanId)->pluck('id')->toArray();
            $prodiId = $faker->randomElement($prodiIdsForJurusan);

            $faker = Faker::create('id_ID');

            // Get all jurusan and prodi IDs for reference
            $jurusanIds = Jurusan::pluck('id')->toArray();
            $dosenIds = Dosen::pluck('id')->toArray();
            // Create angkatan between 2018-2023
            $angkatan = $faker->numberBetween(2018, 2023);

            // Create mahasiswa record
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $angkatan . $faker->unique()->numerify('#####'),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween('-25 years', '-18 years'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'jurusan_id' => $jurusanId,
                'prodi_id' => $prodiId,
                'angkatan' => $angkatan,
                'status' => $faker->randomElement(['aktif', 'cuti', 'lulus']),
                'dosen_wali_id' => $faker->randomElement($dosenIds),
            ]);
        }
    }
}

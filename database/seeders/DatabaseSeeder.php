<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
            TahunAjaranSeeder::class,
            KelasSeeder::class,
            JadwalSeeder::class,
        ]);
    }
}

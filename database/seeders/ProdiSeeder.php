<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            ['jurusan_id' => 1, 'nama_prodi' => 'Teknik Informatika'],
            ['jurusan_id' => 2, 'nama_prodi' => 'Sistem Informasi'],
        ]);
    }
}

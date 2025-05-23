<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_ajaran')->insert([
            ['nama' => '2024/2025', 'semester' => 'ganjil', 'status' =>true ],
            ['nama' => '2023/2024', 'semester' => 'genap', 'status' => false],
        ]);
    }
}

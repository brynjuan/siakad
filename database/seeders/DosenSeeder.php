<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dosen manual
        $dosenData = [
[
                'name' => 'Mohammad Yazdi Pusadan',
                'email' => 'yazdi.ti@untad.ac.id',
                'nidn' => '1234567890',
                'gelar' => 'S.Kom., M.Eng.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Soekarno Hatta No. 88, Palu',
                'no_hp' => '08114540055',
            ],
            [
                'name' => 'SEPTIANO ANGGUN PRATAMA',
                'email' => 'ano.si@untad.ac.id',
                'nidn' => '9876543210',
                'gelar' => 'M.I.Kom., M.Kom.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 10, Palu',
                'no_hp' => '085777620862',
            ],
            [
                'name' => 'Rizka Ardiansyah',
                'email' => 'rizka.ti@untad.ac.id',
                'nidn' => '1122334455',
                'gelar' => 'S.Kom.,M.Kom.',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Raya No. 45, Palu',
                'no_hp' => '085217776619',
            ],
            [
                'name' => 'Anita Ahmad Kasim',
                'email' => 'anita.ti@untad.ac.id',
                'nidn' => '2233445566',
                'gelar' => 'S.Kom., M.Cs.',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pemuda No. 56, Palu',
                'no_hp' => '081241232008',
            ],
        ];

        foreach ($dosenData as $data) {
            // Create user with role dosen
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);

            // Create dosen record
            Dosen::create([
                'user_id' => $user->id,
                'nidn' => $data['nidn'],
                'gelar' => $data['gelar'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
            ]);
        }
    }
}

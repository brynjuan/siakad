<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Create 10 lecturers
        for ($i = 0; $i < 10; $i++) {
            // Create user with role dosen
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);

            // Create dosen record
            Dosen::create([
                'user_id' => $user->id,
                'nidn' => $faker->unique()->numerify('##########'),
                'gelar' => $faker->randomElement(['S.Kom., M.Kom.', 'S.T., M.T.', 'S.Si., M.Sc.', 'S.Pd., M.Pd.']),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
            ]);
        }
    }
}

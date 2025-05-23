<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all kelas
        $allKelas = Kelas::all();

        if ($allKelas->isEmpty()) {
            $this->command->info('No kelas found. Please run the KelasSeeder first.');
            return;
        }

        // Days of the week
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // Rooms
        $rooms = ['A101', 'A102', 'A103', 'B201', 'B202', 'B203', 'C301', 'C302', 'C303', 'D401', 'D402', 'D403'];

        // Time slots
        $timeSlots = [
            ['08:00', '09:40'],
            ['10:00', '11:40'],
            ['13:00', '14:40'],
            ['15:00', '16:40'],
        ];

        // Create jadwal for each kelas
        $jadwalCount = 0;
        foreach ($allKelas as $kelas) {
            // Pick a random day
            $day = $days[array_rand($days)];

            // Pick a random time slot
            $timeSlot = $timeSlots[array_rand($timeSlots)];

            // Pick a random room
            $room = $rooms[array_rand($rooms)];

            // Create jadwal
            Jadwal::create([
                'kelas_id' => $kelas->id,
                'hari' => $day,
                'jam_mulai' => $timeSlot[0],
                'jam_selesai' => $timeSlot[1],
                'ruang' => $room,
            ]);

            $jadwalCount++;
        }

        $this->command->info("Created {$jadwalCount} jadwal records.");
    }
}

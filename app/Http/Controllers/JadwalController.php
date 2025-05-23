<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JadwalController extends Controller
{
    /**
     * Display weekly schedule for the logged-in student
     */
    public function index(): View
    {
        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        // Get current KRS entries with classes and schedules
        $krsEntries = Krs::with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwal'])
            ->where('mahasiswa_id', $mahasiswa->id);

        // Filter by active semester if available
        if ($tahunAjaran) {
            $krsEntries = $krsEntries->where('tahun_ajaran', $tahunAjaran->nama)
                ->where('semester', $tahunAjaran->semester);
        } else {
            // If no active semester, get the most recent KRS entries
            $latestKrs = Krs::where('mahasiswa_id', $mahasiswa->id)
                ->orderBy('tahun_ajaran', 'desc')
                ->orderBy('semester', 'desc')
                ->first();

            if ($latestKrs) {
                $krsEntries = $krsEntries->where('tahun_ajaran', $latestKrs->tahun_ajaran)
                    ->where('semester', $latestKrs->semester);
            }
        }

        $krsEntries = $krsEntries->get();

        // Organize schedule by days of the week
        $weeklySchedule = [
            'Senin' => [],
            'Selasa' => [],
            'Rabu' => [],
            'Kamis' => [],
            'Jumat' => [],
            'Sabtu' => []
        ];

        foreach ($krsEntries as $krs) {
            foreach ($krs->kelas->jadwal as $jadwal) {
                $weeklySchedule[$jadwal->hari][] = [
                    'mataKuliah' => $krs->kelas->mataKuliah->nama_mk,
                    'kode_mk' => $krs->kelas->mataKuliah->kode_mk,
                    'kelas' => $krs->kelas->nama_kelas,
                    'sks' => $krs->kelas->mataKuliah->sks,
                    'dosen' => $krs->kelas->dosen->user->name,
                    'ruang' => $jadwal->ruang,
                    'jam_mulai' => $jadwal->jam_mulai->format('H:i'),
                    'jam_selesai' => $jadwal->jam_selesai->format('H:i'),
                ];

                // Sort classes by start time
                usort($weeklySchedule[$jadwal->hari], function ($a, $b) {
                    return $a['jam_mulai'] <=> $b['jam_mulai'];
                });
            }
        }

        return view('jadwal.index', [
            'mahasiswa' => $mahasiswa,
            'weeklySchedule' => $weeklySchedule,
            'tahunAjaran' => $tahunAjaran,
            'krsEntries' => $krsEntries
        ]);
    }
}

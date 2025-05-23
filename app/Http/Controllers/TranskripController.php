<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TranskripController extends Controller
{
    /**
     * Mapping nilai huruf ke bobot untuk perhitungan IP
     */
    private $bobotNilai = [
        'A' => 4.0,
        'A-' => 3.7,
        'B+' => 3.3,
        'B' => 3.0,
        'B-' => 2.7,
        'C+' => 2.3,
        'C' => 2.0,
        'C-' => 1.7,
        'D' => 1.0,
        'E' => 0.0
    ];

    /**
     * Display transkrip selection page with available semesters
     */
    public function index(): View
    {
        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get all semesters where the student has KRS with nilai
        $semesters = Krs::select('tahun_ajaran', 'semester')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereHas('nilai') // Only include semesters with grades
            ->distinct()
            ->orderBy('tahun_ajaran')
            ->orderBy(DB::raw("CASE WHEN semester = 'ganjil' THEN 1 WHEN semester = 'genap' THEN 2 ELSE 3 END"))
            ->get();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        // Calculate overall GPA
        $ipk = $this->calculateIPK($mahasiswa);

        // Get total SKS that have been completed (have nilai)
        $totalSks = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->whereHas('nilai')
            ->whereHas('kelas.mataKuliah')
            ->with('kelas.mataKuliah')
            ->get()
            ->sum(function ($krs) {
                return $krs->kelas->mataKuliah->sks;
            });

        return view('transkrip.index', compact('mahasiswa', 'semesters', 'tahunAjaran', 'ipk', 'totalSks'));
    }

    /**
     * Show transkrip for a specific semester
     */
    public function show(Request $request): View
    {
        $request->validate([
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|string|in:ganjil,genap,pendek',
        ]);

        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get all mata kuliah with nilai for this semester
        $mataKuliah = Krs::with(['kelas.mataKuliah', 'nilai'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('semester', $request->semester)
            ->whereHas('nilai')
            ->get();

        // Calculate IP Semester
        $ipSemester = $this->calculateIPSemester($mataKuliah);

        // Get total SKS for this semester
        $totalSksSemester = $mataKuliah->sum(function ($krs) {
            return $krs->kelas->mataKuliah->sks;
        });

        return view('transkrip.show', compact(
            'mahasiswa',
            'mataKuliah',
            'ipSemester',
            'totalSksSemester',
            'request'
        ));
    }

    /**
     * Calculate IP for a specific semester
     */
    private function calculateIPSemester($mataKuliah)
    {
        $totalBobot = 0;
        $totalSks = 0;

        foreach ($mataKuliah as $krs) {
            $sks = $krs->kelas->mataKuliah->sks;
            $nilaiHuruf = $krs->nilai->nilai_huruf;

            // Skip if nilai huruf doesn't exist or not in our mapping
            if (!$nilaiHuruf || !isset($this->bobotNilai[$nilaiHuruf])) {
                continue;
            }

            $bobot = $this->bobotNilai[$nilaiHuruf];
            $totalBobot += ($bobot * $sks);
            $totalSks += $sks;
        }

        if ($totalSks == 0) {
            return 0;
        }

        return round($totalBobot / $totalSks, 2);
    }

    /**
     * Calculate IPK (overall GPA)
     */
    private function calculateIPK($mahasiswa)
    {
        // Get all mata kuliah with nilai
        $allMataKuliah = Krs::with(['kelas.mataKuliah', 'nilai'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereHas('nilai')
            ->get();

        return $this->calculateIPSemester($allMataKuliah);
    }

    /**
     * Generate PDF of the entire transkrip
     */
    public function printAll(Request $request)
    {
        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get all mata kuliah with nilai grouped by semester
        $semesters = Krs::select('tahun_ajaran', 'semester')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereHas('nilai')
            ->distinct()
            ->orderBy('tahun_ajaran')
            ->orderBy(DB::raw("CASE WHEN semester = 'ganjil' THEN 1 WHEN semester = 'genap' THEN 2 ELSE 3 END"))
            ->get();

        $transcriptData = [];

        foreach ($semesters as $sem) {
            $mataKuliah = Krs::with(['kelas.mataKuliah', 'nilai'])
                ->where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_ajaran', $sem->tahun_ajaran)
                ->where('semester', $sem->semester)
                ->whereHas('nilai')
                ->get();

            $ipSemester = $this->calculateIPSemester($mataKuliah);

            $transcriptData[] = [
                'tahun_ajaran' => $sem->tahun_ajaran,
                'semester' => $sem->semester,
                'mataKuliah' => $mataKuliah,
                'ip' => $ipSemester
            ];
        }

        $ipk = $this->calculateIPK($mahasiswa);

        // This would typically call a PDF generation library
        // For now, we'll return a view that could be printed
        return view('transkrip.print', compact('mahasiswa', 'transcriptData', 'ipk'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NilaiController extends Controller
{
    /**
     * Display list of classes taught by the current dosen
     */
    public function index(): View
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        // Get all classes taught by this dosen
        $kelas = Kelas::with('mataKuliah')
            ->where('dosen_id', $dosen->id)
            ->when($tahunAjaran, function ($query) use ($tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran->nama)
                    ->where('semester', $tahunAjaran->semester);
            })
            ->get();

        // Count students in each class
        foreach ($kelas as $k) {
            $k->student_count = Krs::where('kelas_id', $k->id)->count();
        }

        return view('nilai.index', compact('kelas', 'dosen', 'tahunAjaran'));
    }

    /**
     * Display students enrolled in a class for grading
     */
    public function show(Kelas $kelas): View|RedirectResponse
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen teaches this class
        if ($kelas->dosen_id !== $dosen->id) {
            return redirect()->route('nilai.index')
                ->with('error', 'Anda tidak mengajar kelas ini.');
        }

        // Get all students enrolled in this class
        $students = Krs::with(['mahasiswa.user', 'nilai'])
            ->where('kelas_id', $kelas->id)
            ->get();

        // Load related data
        $kelas->load('mataKuliah');

        return view('nilai.show', compact('kelas', 'students', 'dosen'));
    }

    /**
     * Store or update grades for a student
     */
    public function update(Request $request, Kelas $kelas): RedirectResponse
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen teaches this class
        if ($kelas->dosen_id !== $dosen->id) {
            return redirect()->route('nilai.index')
                ->with('error', 'Anda tidak mengajar kelas ini.');
        }

        DB::beginTransaction();

        try {
            foreach ($request->nilai as $krsId => $nilaiAngka) {
                // Check if this KRS is for this class
                $krs = Krs::where('id', $krsId)
                    ->where('kelas_id', $kelas->id)
                    ->first();

                if (!$krs) {
                    continue;
                }

                // Skip empty values
                if ($nilaiAngka === null || $nilaiAngka === '') {
                    continue;
                }

                // Get or create nilai record
                $nilai = Nilai::firstOrNew(['krs_id' => $krsId]);

                // Set nilai and keterangan
                $nilai->nilai_angka = $nilaiAngka;
                if (isset($request->keterangan[$krsId])) {
                    $nilai->keterangan = $request->keterangan[$krsId];
                }

                $nilai->save();
            }

            DB::commit();

            return redirect()->route('nilai.show', $kelas->id)
                ->with('success', 'Nilai berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Export grades for a class
     */
    public function export(Kelas $kelas): RedirectResponse
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen teaches this class
        if ($kelas->dosen_id !== $dosen->id) {
            return redirect()->route('nilai.index')
                ->with('error', 'Anda tidak mengajar kelas ini.');
        }

        // Implementation of export functionality
        // This could download a CSV/Excel file with all grades

        return redirect()->route('nilai.show', $kelas->id)
            ->with('info', 'Fitur export belum tersedia.');
    }
}

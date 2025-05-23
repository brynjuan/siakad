<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KrsApprovalController extends Controller
{
    /**
     * Display list of students under current dosen wali
     */
    public function index(): View
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        // Get all mahasiswa that have this dosen as dosen wali
        $mahasiswas = Mahasiswa::with(['user', 'prodi'])
            ->where('dosen_wali_id', $dosen->id)
            ->get();

        // Get KRS data for each mahasiswa
        foreach ($mahasiswas as $mahasiswa) {
            $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_ajaran', $tahunAjaran->nama ?? '')
                ->where('semester', $tahunAjaran->semester ?? '')
                ->get();

            $mahasiswa->krs_count = $krsList->count();
            $mahasiswa->krs_status = $krsList->count() > 0 ? $krsList->first()->status : 'belum_mengisi';
        }

        return view('krs.approval.index', compact('mahasiswas', 'dosen', 'tahunAjaran'));
    }

    /**
     * Display details of a student's KRS for approval
     */
    public function show(Mahasiswa $mahasiswa): View|RedirectResponse
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen is the academic advisor of this student
        if ($mahasiswa->dosen_wali_id !== $dosen->id) {
            return redirect()->route('krs.approval.index')
                ->with('error', 'Mahasiswa ini bukan bimbingan Anda.');
        }

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        if (!$tahunAjaran) {
            return redirect()->route('krs.approval.index')
                ->with('error', 'Tidak ada tahun ajaran aktif saat ini.');
        }

        // Get KRS data for this student
        $krs = Krs::with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwal'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_ajaran', $tahunAjaran->nama)
            ->where('semester', $tahunAjaran->semester)
            ->get();

        // Calculate total SKS
        $totalSks = $krs->sum(function ($item) {
            return $item->kelas->mataKuliah->sks;
        });

        return view('krs.approval.show', compact('krs', 'mahasiswa', 'dosen', 'tahunAjaran', 'totalSks'));
    }

    /**
     * Approve a student's KRS
     */
    public function approve(Mahasiswa $mahasiswa): RedirectResponse
    {
        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen is the academic advisor of this student
        if ($mahasiswa->dosen_wali_id !== $dosen->id) {
            return redirect()->route('krs.approval.index')
                ->with('error', 'Mahasiswa ini bukan bimbingan Anda.');
        }

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->firstOrFail();

        DB::beginTransaction();

        try {
            // Update all KRS entries for this student to 'approved'
            Krs::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_ajaran', $tahunAjaran->nama)
                ->where('semester', $tahunAjaran->semester)
                ->update(['status' => 'disetujui']);

            DB::commit();

            return redirect()->route('krs.approval.index')
                ->with('success', 'KRS mahasiswa berhasil disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Reject a student's KRS
     */
    public function reject(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255',
        ]);

        // Get current logged in dosen
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        // Check if this dosen is the academic advisor of this student
        if ($mahasiswa->dosen_wali_id !== $dosen->id) {
            return redirect()->route('krs.approval.index')
                ->with('error', 'Mahasiswa ini bukan bimbingan Anda.');
        }

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->firstOrFail();

        DB::beginTransaction();

        try {
            // Update all KRS entries for this student to 'rejected'
            Krs::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_ajaran', $tahunAjaran->nama)
                ->where('semester', $tahunAjaran->semester)
                ->update([
                    'status' => 'ditolak',
                    'keterangan' => $request->alasan_penolakan
                ]);

            DB::commit();

            return redirect()->route('krs.approval.index')
                ->with('success', 'KRS mahasiswa berhasil ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

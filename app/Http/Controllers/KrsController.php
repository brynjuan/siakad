<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KrsController extends Controller
{
    /**
     * Display KRS list for current student
     */
    public function index(): View
    {
        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        // Get KRS data
        $krs = Krs::with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwal'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_ajaran', $tahunAjaran->nama ?? '')
            ->where('semester', $tahunAjaran->semester ?? '')
            ->get();

        // Calculate total SKS
        $totalSks = $krs->sum(function ($item) {
            return $item->kelas->mataKuliah->sks;
        });

        return view('krs.index', compact('krs', 'mahasiswa', 'tahunAjaran', 'totalSks'));
    }

    /**
     * Show form to create new KRS
     */
    public function create(): View|RedirectResponse
    {
        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        if (!$tahunAjaran) {
            return redirect()->route('krs.index')
                ->with('error', 'Tidak ada tahun ajaran aktif saat ini. KRS tidak dapat diisi.');
        }

        // Check if KRS is still open for this semester
        $now = now();
        if ($tahunAjaran->tanggal_mulai && $tahunAjaran->tanggal_selesai) {
            $mulai = \Carbon\Carbon::parse($tahunAjaran->tanggal_mulai);
            $selesai = \Carbon\Carbon::parse($tahunAjaran->tanggal_selesai);

            if ($now->lt($mulai)) {
                return redirect()->route('krs.index')
                    ->with('error', 'Periode pengisian KRS belum dimulai. Pengisian dimulai pada ' . $mulai->format('d M Y') . '.');
            }

            if ($now->gt($selesai)) {
                return redirect()->route('krs.index')
                    ->with('error', 'Periode pengisian KRS sudah berakhir pada ' . $selesai->format('d M Y') . '.');
            }
        }

        // Get available kelas for student's prodi
        $query = Kelas::with(['mataKuliah', 'dosen.user', 'jadwal'])
            ->whereHas('mataKuliah', function ($query) use ($mahasiswa) {
                $query->where('prodi_id', $mahasiswa->prodi_id);
            })
            ->where('tahun_ajaran', $tahunAjaran->nama)
            ->where('semester', $tahunAjaran->semester);

        // Apply filters if provided
        if (request()->filled('semester')) {
            $query->whereHas('mataKuliah', function ($q) {
                $q->where('semester', request('semester'));
            });
        }

        if (request()->filled('hari')) {
            $query->whereHas('jadwal', function ($q) {
                $q->where('hari', request('hari'));
            });
        }

        if (request()->filled('search')) {
            $search = request('search');
            $query->whereHas('mataKuliah', function ($q) use ($search) {
                $q->where('nama_mk', 'like', "%{$search}%")
                    ->orWhere('kode_mk', 'like', "%{$search}%");
            });
        }

        $kelas = $query->get();

        // Get already selected kelas IDs
        $selectedKelasIds = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_ajaran', $tahunAjaran->nama)
            ->where('semester', $tahunAjaran->semester)
            ->pluck('kelas_id')
            ->toArray();

        return view('krs.create', compact('kelas', 'mahasiswa', 'tahunAjaran', 'selectedKelasIds'));
    }

    /**
     * Store KRS data
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kelas_ids' => 'required|array',
            'kelas_ids.*' => 'exists:kelas,id',
        ]);

        // Get current logged in mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        // Get active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status', true)->first();

        if (!$tahunAjaran) {
            return redirect()->route('krs.index')
                ->with('error', 'Tidak ada tahun ajaran aktif saat ini. KRS tidak dapat diisi.');
        }

        // Check if KRS is still open for this semester
        $now = now();
        if ($tahunAjaran->tanggal_mulai && $tahunAjaran->tanggal_selesai) {
            $mulai = \Carbon\Carbon::parse($tahunAjaran->tanggal_mulai);
            $selesai = \Carbon\Carbon::parse($tahunAjaran->tanggal_selesai);

            if ($now->lt($mulai) || $now->gt($selesai)) {
                return redirect()->route('krs.index')
                    ->with('error', 'Periode pengisian KRS tidak dalam rentang waktu yang diizinkan.');
            }
        }

        // Verify that all selected classes are from this semester and year
        $validKelasCount = Kelas::whereIn('id', $request->kelas_ids)
            ->where('tahun_ajaran', $tahunAjaran->nama)
            ->where('semester', $tahunAjaran->semester)
            ->count();

        if ($validKelasCount != count($request->kelas_ids)) {
            return redirect()->route('krs.create')
                ->with('error', 'Beberapa kelas yang dipilih tidak valid untuk semester aktif.')
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Delete existing KRS entries for this semester (if updating)
            Krs::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_ajaran', $tahunAjaran->nama)
                ->where('semester', $tahunAjaran->semester)
                ->delete();

            // Create new KRS entries
            foreach ($request->kelas_ids as $kelasId) {
                Krs::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'kelas_id' => $kelasId,
                    'tahun_ajaran' => $tahunAjaran->nama,
                    'semester' => $tahunAjaran->semester,
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            return redirect()->route('krs.index')
                ->with('success', 'KRS berhasil disimpan. Silahkan tunggu persetujuan dari dosen wali.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show KRS detail
     */
    public function show(Krs $krs): View
    {
        // Make sure current user is the owner of the KRS
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        if ($krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403, 'Unauthorized action.');
        }

        $krs->load(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwal']);

        return view('krs.show', compact('krs'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa.
     */
    public function index(): View
    {
        $search = request()->query('search');
        $status = request()->query('status');
        $jurusan = request()->query('jurusan');

        $query = Mahasiswa::with(['user', 'jurusan', 'prodi', 'dosenWali.user']);

        // Apply search filter
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('nim', 'like', "%{$search}%");
        }

        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Apply jurusan filter
        if ($jurusan) {
            $query->where('jurusan_id', $jurusan);
        }

        $mahasiswas = $query->latest()->paginate(10)->withQueryString();
        $jurusans = Jurusan::all();

        return view('mahasiswa.index', compact('mahasiswas', 'jurusans'));
    }

    /**
     * Show the form for creating a new mahasiswa.
     */
    public function create(): View
    {
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $dosens = \App\Models\Dosen::with('user')->get();

        return view('mahasiswa.create', compact('jurusans', 'prodis', 'dosens'));
    }

    /**
     * Store a newly created mahasiswa in storage.
     */
    public function store(MahasiswaRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Create user first
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            // Create mahasiswa record
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'jurusan_id' => $request->jurusan_id,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
                'dosen_wali_id' => $request->dosen_wali_id,
            ]);

            DB::commit();

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified mahasiswa.
     */
    public function show(Mahasiswa $mahasiswa): View
    {
        // Load relationships and calculate statistics
        $mahasiswa->load(['user', 'jurusan', 'prodi', 'dosenWali.user']);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa): View
    {
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $dosens = \App\Models\Dosen::with('user')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans', 'prodis', 'dosens'));
    }

    /**
     * Update the specified mahasiswa in storage.
     */
    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Update user data
            $mahasiswa->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $mahasiswa->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // Update mahasiswa data
            $mahasiswa->update([
                'nim' => $request->nim,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'jurusan_id' => $request->jurusan_id,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
                'dosen_wali_id' => $request->dosen_wali_id,
            ]);

            DB::commit();

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified mahasiswa from storage.
     */
    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $user = $mahasiswa->user;

            // Delete mahasiswa first (foreign key constraint)
            $mahasiswa->delete();

            // Delete associated user
            $user->delete();

            DB::commit();

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get prodis based on jurusan_id (for dynamic dropdown)
     */
    public function getProdi(int $jurusanId)
    {
        $prodis = Prodi::where('jurusan_id', $jurusanId)->get();

        return response()->json($prodis);
    }
}

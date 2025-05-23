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
        $mahasiswas = Mahasiswa::with(['user', 'jurusan', 'prodi'])->latest()->paginate(10);

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new mahasiswa.
     */
    public function create(): View
    {
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();

        return view('mahasiswa.create', compact('jurusans', 'prodis'));
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
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa): View
    {
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();

        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans', 'prodis'));
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

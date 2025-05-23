<?php

use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Middleware\EnsureMahasiswaRole;
use App\Http\Middleware\EnsureDosenRole;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsApprovalController;
use App\Http\Controllers\TranskripController;
use App\Http\Controllers\NilaiController;
use App\Http\Middleware\EnsureAdminRole;
use Illuminate\Support\Facades\Route;

Route::redirect("/", '/login');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('krs', KrsController::class)->only(['index', 'create', 'store', 'show'])->middleware(EnsureMahasiswaRole::class);

    Route::middleware(['auth', EnsureMahasiswaRole::class])->prefix('transkrip')->name('transkrip.')->group(function () {
        Route::get('/', [TranskripController::class, 'index'])->name('index');
        Route::get('/show', [TranskripController::class, 'show'])->name('show');
        Route::get('/print', [TranskripController::class, 'printAll'])->name('print');
    });
    Route::middleware(['auth', EnsureAdminRole::class])->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::get('prodi-by-jurusan/{jurusan}', [MahasiswaController::class, 'getProdi'])->name('prodi.by.jurusan');
    });


    Route::middleware(['auth', EnsureDosenRole::class])->prefix('krs-approval')->name('krs.approval.')->group(function () {
        Route::get('/', [KrsApprovalController::class, 'index'])->name('index');
        Route::get('/{mahasiswa}', [KrsApprovalController::class, 'show'])->name('show');
        Route::post('/{mahasiswa}/approve', [KrsApprovalController::class, 'approve'])->name('approve');
        Route::post('/{mahasiswa}/reject', [KrsApprovalController::class, 'reject'])->name('reject');
    });

    Route::middleware(['auth', EnsureDosenRole::class])->prefix('nilai')->name('nilai.')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('index');
        Route::get('/{kelas}', [NilaiController::class, 'show'])->name('show');
        Route::post('/{kelas}', [NilaiController::class, 'update'])->name('update');
        Route::get('/{kelas}/export', [NilaiController::class, 'export'])->name('export');
    });
});

require __DIR__ . '/auth.php';

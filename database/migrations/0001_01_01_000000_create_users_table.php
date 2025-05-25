<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'dosen', 'mahasiswa']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // jurusan
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan');
            $table->timestamps();
        });

        // prodi
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->string('nama_prodi');
            $table->timestamps();
        });

        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nidn')->unique();
            $table->string('gelar');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('no_hp');
            $table->timestamps();
        });
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->foreignId('dosen_wali_id')->nullable()->constrained('dosens')->onDelete('set null');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->foreignId('jurusan_id')->constrained('jurusan');
            $table->foreignId('prodi_id')->constrained('prodi');
            $table->year('angkatan');
            $table->enum('status', ['aktif', 'cuti', 'lulus', 'do']);
            $table->timestamps();
        });
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->unsignedTinyInteger('sks');
            $table->unsignedTinyInteger('semester');
            $table->enum('tipe', ['wajib', 'pilihan']);
            $table->foreignId('prodi_id')->constrained('prodi');
            $table->timestamps();
        });
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah');
            $table->foreignId('dosen_id')->constrained('dosens');
            $table->string('nama_kelas'); // A, B, C
            $table->string('tahun_ajaran');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->timestamps();
        });
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('tahun_ajaran');
            $table->string('keterangan')->nullable();
            $table->unsignedTinyInteger('semester');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_id')->constrained()->onDelete('cascade');
            $table->float('nilai_angka')->nullable();
            $table->string('nilai_huruf', 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // One KRS can only have one nilai
            $table->unique('krs_id');
        });
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruang');
            $table->timestamps();
        });
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // ex: 2024/2025
            $table->enum('semester', ['ganjil', 'genap']);
            $table->date('tanggal_mulai')->nullable()->comment('Tanggal mulai pengisian KRS');
            $table->date('tanggal_selesai')->nullable()->comment('Tanggal akhir pengisian KRS');
            $table->boolean('status')->default(false); // true = aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
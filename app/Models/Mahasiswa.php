<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'jurusan_id',
        'prodi_id',
        'angkatan',
        'status',
        'dosen_wali_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the user that owns the mahasiswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jurusan that the mahasiswa belongs to.
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Get the prodi that the mahasiswa belongs to.
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Get the dosen wali (academic advisor) that the mahasiswa belongs to.
     */
    public function dosenWali(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id');
    }

    /**
     * Get KRS records for this mahasiswa.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    /**
     * Get all active courses the student is enrolled in.
     */
    public function activeCourses()
    {
        return $this->hasManyThrough(
            Kelas::class,
            Krs::class,
            'mahasiswa_id', // Foreign key on Krs table
            'id',           // Foreign key on Kelas table
            'id',           // Local key on Mahasiswa table
            'kelas_id'      // Local key on Krs table
        )->where('krs.status', 'disetujui');
    }

    /**
     * Calculate total SKS completed by student.
     */
    public function getTotalSksAttribute()
    {
        return $this->krs()
            ->where('status', 'disetujui')
            ->join('kelas', 'krs.kelas_id', '=', 'kelas.id')
            ->join('mata_kuliah', 'kelas.mata_kuliah_id', '=', 'mata_kuliah.id')
            ->sum('mata_kuliah.sks');
    }

    /**
     * Calculate student's GPA (IPK).
     */
    public function getIpkAttribute()
    {
        $krsWithNilai = $this->krs()
            ->where('status', 'disetujui')
            ->join('kelas', 'krs.kelas_id', '=', 'kelas.id')
            ->join('mata_kuliah', 'kelas.mata_kuliah_id', '=', 'mata_kuliah.id')
            ->join('nilai', 'krs.id', '=', 'nilai.krs_id')
            ->whereNotNull('nilai.nilai_angka')
            ->select('mata_kuliah.sks', 'nilai.nilai_angka', 'nilai.nilai_huruf')
            ->get();

        if ($krsWithNilai->isEmpty()) {
            return 0.00;
        }

        $totalWeight = 0;
        $totalSks = 0;

        foreach ($krsWithNilai as $item) {
            // If nilai_huruf is available, use it directly, otherwise convert from nilai_angka
            $nilaiMutu = isset($item->nilai_huruf) ?
                $this->getNilaiMutuFromHuruf($item->nilai_huruf) :
                $this->getNilaiMutuFromAngka($item->nilai_angka);

            $totalWeight += $nilaiMutu * $item->sks;
            $totalSks += $item->sks;
        }

        return $totalSks > 0 ? round($totalWeight / $totalSks, 2) : 0.00;
    }

    /**
     * Convert nilai huruf to nilai mutu
     */
    private function getNilaiMutuFromHuruf($nilaiHuruf)
    {
        switch ($nilaiHuruf) {
            case 'A':
                return 4.00;
            case 'A-':
                return 3.75;
            case 'B+':
                return 3.50;
            case 'B':
                return 3.00;
            case 'B-':
                return 2.75;
            case 'C+':
                return 2.50;
            case 'C':
                return 2.00;
            case 'D':
                return 1.00;
            case 'E':
                return 0.00;
            default:
                return 0.00;
        }
    }

    /**
     * Convert nilai angka to nilai mutu
     */
    private function getNilaiMutuFromAngka($nilaiAngka)
    {
        if ($nilaiAngka >= 85) return 4.00;    // A
        if ($nilaiAngka >= 80) return 3.75;    // A-
        if ($nilaiAngka >= 75) return 3.50;    // B+
        if ($nilaiAngka >= 70) return 3.00;    // B
        if ($nilaiAngka >= 65) return 2.75;    // B-
        if ($nilaiAngka >= 60) return 2.50;    // C+
        if ($nilaiAngka >= 55) return 2.00;    // C
        if ($nilaiAngka >= 40) return 1.00;    // D
        return 0.00;                           // E
    }

    /**
     * Calculate current or last semester.
     */
    public function getCurrentSemesterAttribute()
    {
        $highestSemester = $this->krs()
            ->where('status', 'disetujui')
            ->max('semester');

        return $highestSemester ?: '-';
    }

    /**
     * Count number of courses taken.
     */
    public function getTotalMataKuliahAttribute()
    {
        return $this->krs()
            ->where('status', 'disetujui')
            ->count();
    }
}

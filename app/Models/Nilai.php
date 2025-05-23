<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'krs_id',
        'nilai_angka',
        'nilai_huruf',
        'keterangan'
    ];

    /**
     * Get the KRS record associated with the nilai.
     */
    public function krs(): BelongsTo
    {
        return $this->belongsTo(Krs::class);
    }

    /**
     * Convert nilai angka to nilai huruf automatically
     */
    public function setNilaiAngkaAttribute($value)
    {
        $this->attributes['nilai_angka'] = $value;
        $this->attributes['nilai_huruf'] = $this->convertToHuruf($value);
    }

    /**
     * Convert nilai angka to huruf based on standard conversion
     */
    private function convertToHuruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 50) return 'C-';
        if ($nilai >= 40) return 'D';
        return 'E';
    }
}

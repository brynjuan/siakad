<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Krs extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'kelas_id',
        'tahun_ajaran',
        'semester',
        'status'
    ];
    /**
     * @return BelongsTo<Mahasiswa,Krs>
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    /**
     * @return BelongsTo<Kelas,Krs>
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
    /**
     * @return HasOne<Nilai,Krs>
     */
    public function nilai(): HasOne
    {
        return $this->hasOne(Nilai::class);
    }
}

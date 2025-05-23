<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_kuliah_id',
        'dosen_id',
        'nama_kelas',
        'tahun_ajaran',
        'semester'
    ];
    /**
     * @return BelongsTo<MataKuliah,Kelas>
     */
    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }
    /**
     * @return BelongsTo<Dosen,Kelas>
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
    /**
     * @return HasMany<Krs,Kelas>
     */
    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class);
    }
    /**
     * @return HasMany<Jadwal,Kelas>
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}

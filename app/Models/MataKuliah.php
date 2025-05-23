<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks', 'semester', 'tipe', 'prodi_id'
    ];
    /**
     * @return BelongsTo<Prodi,MataKuliah>
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
    /**
     * @return HasMany<Kelas,MataKuliah>
     */
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}

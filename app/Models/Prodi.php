<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $fillable = ['jurusan_id', 'nama_prodi'];
    /**
     * @return BelongsTo<Jurusan,Prodi>
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }
    /**
     * @return HasMany<MataKuliah,Prodi>
     */
    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }
}

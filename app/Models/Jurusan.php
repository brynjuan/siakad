<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];
    /**
     * @return HasMany<Prodi,Jurusan>
     */
    public function prodis(): HasMany
    {
        return $this->hasMany(Prodi::class);
    }
    /**
     * @return HasMany<Mahasiswa,Jurusan>
     */
    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
}

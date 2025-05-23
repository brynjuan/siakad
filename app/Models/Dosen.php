<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nidn',
        'gelar',
        'jenis_kelamin',
        'alamat',
        'no_hp'
    ];
    /**
     * @return BelongsTo<User,Dosen>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return HasMany<Kelas,Dosen>
     */
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}

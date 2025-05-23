<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang'
    ];

    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
    ];
    /**
     * @return BelongsTo<Kelas,Jadwal>
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}

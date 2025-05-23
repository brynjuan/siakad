<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'nama',
        'semester',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
    protected $dates = ['tanggal_mulai', 'tanggal_selesai'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * @return HasOne<Mahasiswa,User>
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }
    /**
     * @return HasOne<Dosen,User>
     */
    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class);
    }

    /**
     * @param array<string,mixed> $array
     */
}

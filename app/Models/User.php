<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengaduansarans()
    {
        return $this->hasOne(Pengaduansaran::class, 'id_user');
    }

    public function siswa()
    {
        return $this->hasOne(\App\Models\Siswa::class, 'id_user');
    }

    public function orangtuas()
    {
        return $this->hasOne(Orangtua::class, 'id_user');
    }

    public function riwayats()
    {
        return $this->hasOne(Riwayat::class, 'id_user');
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama', 'jenis_kelamin', 'no_tlp', 'id_user', 'id_siswa'
    ];

    public function user()
    {        
        return $this->belongsTo(User::class, 'id_user');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}

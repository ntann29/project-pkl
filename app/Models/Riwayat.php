<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'foto_bukti', 'status', 'id_user', 'id_pengaduansaran'
    ]; 

    public function user()
    {        
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pengaduansaran()
    {        
        return $this->belongsTo(Pengaduansaran::class, 'id_pengaduansaran');
    }
}

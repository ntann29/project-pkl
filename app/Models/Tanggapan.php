<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'isi_tanggapan', 'foto_bukti', 'id_pengaduansaran'
    ]; 

    public function pengaduansaran()
    {        
        return $this->belongsTo(Pengaduansaran::class, 'id_pengaduansaran');
    }
}

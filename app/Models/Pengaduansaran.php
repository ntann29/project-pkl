<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduansaran extends Model
{
    use HasFactory;

    protected $table = 'pengaduansarans'; // optional, agar lebih eksplisit

    protected $fillable = [
        'status_user', 'jenis', 'kategori', 'deskripsi', 'foto_bukti', 'status', 'id_user', 'rating'
    ]; 

    public function user()
    {        
        return $this->belongsTo(User::class, 'id_user');
    }        
    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduansaran');
    }
    public function riwayats()
    {
        return $this->hasMany(Riwayat::class, 'id_pengaduansaran');
    }
    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_pengaduansaran');
    }

}
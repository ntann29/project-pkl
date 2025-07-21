<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['id_pengaduansaran', 'id_user', 'isi_komentar'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pengaduansaran()
    {
        return $this->belongsTo(Pengaduansaran::class, 'id_pengaduansaran');
    }
}

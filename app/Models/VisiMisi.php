<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['visi', 'misi', 'deskripsi', 'user_id', 'tahun_akademik_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

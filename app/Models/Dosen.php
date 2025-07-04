<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'asal_prodi',
        'nama_lengkap',
        'nidn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'asal_prodi');
    }
    
}

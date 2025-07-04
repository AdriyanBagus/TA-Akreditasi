<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDosenNew extends Model
{
     use HasFactory;

    protected $table = 'profile_dosen';

    protected $fillable = [
        'asal_prodi',
        'dosen_id',
        'nama',
        'nidn',
        'kualifikasi_pendidikan',
        'sertifikasi_pendidik_profesional',
        'bidang_keahlian',
        'bidang_ilmu_prodi',
    ];

    public function prodi()
    {
        return $this->belongsTo(User::class, 'asal_prodi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}

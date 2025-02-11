<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPendidikan extends Model
{
    protected $table = 'kerjasama_pendidikan';
    protected $fillable = ['user_id', 'lembaga_mitra', 'tingkat', 'judul_kegiatan', 'waktu_durasi','realisasi_kerjasama', 'spk'];
}

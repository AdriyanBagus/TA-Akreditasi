<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPengabdianKepadaMasyarakat extends Model
{
    protected $table = 'kerjasama_pengabdian_kepada_masyarakat';
    protected $fillable = ['user_id', 'lembaga_mitra', 'tingkat', 'judul_kegiatan', 'waktu_durasi','realisasi_kerjasama', 'spk'];
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_dosen_tidak_tetap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key mengacu ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users') // Mengacu ke tabel users
                  ->onDelete('cascade'); // Jika user dihapus, data ini ikut terhapus
            $table->string('nama'); // Nama Dosen Tidak Tetap
            $table->string('asal_instansi'); // Asal Instansi Dosen
            $table->string('kualifikasi_pendidikan'); // Kualifikasi Pendidikan
            $table->string('sertifikasi_pendidik_profesional'); // Sertifikasi Pendidik Profesional
            $table->string('sertifikat_kompetensi'); // Sertifikat Kompetensi
            $table->string('bidang_keahlian'); // Bidang Keahlian
            $table->string('kesesuaian_bidang_ilmu_prodi'); // Kesesuaian Bidang Ilmu dengan Prodi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_dosen_tidak_tetap');
    }
};

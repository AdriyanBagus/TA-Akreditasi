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
        Schema::create('beban_kinerja_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key mengacu ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users') // Mengacu ke tabel users
                  ->onDelete('cascade'); // Jika user dihapus, data ini ikut terhapus
            $table->string('nama'); // Nama Dosen
            $table->integer('nidn'); // Nomor Induk Dosen Nasional (NIDN)
            $table->enum('pengajaran', ['Program studi sendiri', 'Program studi lain', 'Program studi diluar PT']); // Enum pilihan pengajaran
            $table->string('penelitian'); // Penelitian
            $table->string('pkm'); // Pengabdian Kepada Masyarakat (PKM)
            $table->string('penunjang'); // Kegiatan Penunjang
            $table->integer('jumlah_sks'); // Total SKS
            $table->integer('rata_rata_sks'); // Rata-rata SKS
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beban_kinerja_dosen');
    }
};

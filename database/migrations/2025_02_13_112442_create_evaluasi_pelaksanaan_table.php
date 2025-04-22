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
        Schema::create('evaluasi_pelaksanaan', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key mengacu ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users') // Mengacu ke tabel users
                  ->onDelete('cascade'); // Jika user dihapus, data ini ikut terhapus
            $table->integer('nomor_ptk'); // Nomor PTK
            $table->enum('kategori_ptk', ['Mayor', 'Minor', 'Observasi']); // Enum kategori PTK
            $table->string('rencana_penyelesaian'); // Rencana Penyelesaian
            $table->string('realisasi_perbaikan'); // Realisasi Perbaikan
            $table->string('penanggungjawab_perbaikan'); // Penanggung Jawab Perbaikan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_pelaksanaan');
    }
};

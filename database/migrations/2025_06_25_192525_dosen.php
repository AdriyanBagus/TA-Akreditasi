<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asal_prodi');
            $table->foreign('asal_prodi')
                ->references('id')
                ->on('users') 
                ->onDelete('restrict'); // Jika user dihapus, data ini ikut terhapus
            $table->string('nama_lengkap');
            $table->string('nidn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};

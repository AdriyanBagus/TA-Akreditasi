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
        Schema::create('info_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('id_prodi');
            $table->foreign('id_prodi')
                ->references('id')
                ->on('users') 
                ->onDelete('cascade'); // Jika user dihapus, data ini ikut terhapus
            $table->string('nama_dosen');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

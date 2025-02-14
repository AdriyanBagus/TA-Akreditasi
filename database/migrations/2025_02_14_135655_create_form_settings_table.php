<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('form_settings', function (Blueprint $table) {
            $table->id();
            $table->string('form_name')->unique(); // Nama form
            $table->boolean('status')->default(true); // ON (true) atau OFF (false)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_settings');
    }
};


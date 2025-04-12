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
        Schema::create('hadiah', function (Blueprint $table) {
            $table->bigIncrements('id_hadiah');
            $table->string('nama'); 
            $table->text('deskripsi'); 
            $table->string('foto'); 
            $table->unsignedInteger('stok');
            $table->unsignedInteger('point');
            $table->boolean('status')->default(true); // true = aktif, false = nonaktif
            // Kolom untuk stok dan poin yang dibutuhkan untuk menukar hadiah, tidak boleh bernilai negatif
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadiah');
    }
};

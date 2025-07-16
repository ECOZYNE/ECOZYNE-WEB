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
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id('id_kelurahan'); // Primary key untuk tabel kelurahan
            $table->foreignId('id_kecamatan')->constrained('kecamatan', 'id_kecamatan'); // Foreign key ke tabel kecamatan
            $table->string('kelurahan'); // Kolom nama kelurahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahan');
    }
};

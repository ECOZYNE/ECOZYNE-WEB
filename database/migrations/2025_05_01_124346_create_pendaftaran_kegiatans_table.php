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
        Schema::create('pendaftaran_kegiatan', function (Blueprint $table) {
            $table->id('id_pendaftaran_kegiatan');
            // Pastikan id_komunitas hanya didefinisikan satu kali
            $table->foreignId('id_komunitas')->constrained('komunitas', 'id_komunitas'); // Ini yang benar
            $table->foreignId('id_kegiatan')->constrained('kegiatan', 'id_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatan');
    }
};

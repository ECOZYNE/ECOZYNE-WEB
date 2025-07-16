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
        Schema::create('penukaran', function (Blueprint $table) {
            $table->id('id_penukaran');
            // Pastikan id_komunitas hanya didefinisikan satu kali
            $table->foreignId('id_komunitas')->constrained('komunitas', 'id_komunitas'); // Ini yang benar
            $table->enum('status_penukaran', ['menunggu', 'diterima', 'ditolak', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penukaran');
    }
};

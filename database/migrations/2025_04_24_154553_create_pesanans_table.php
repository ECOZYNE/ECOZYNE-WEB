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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            // Pastikan id_komunitas hanya didefinisikan satu kali
            $table->foreignId('id_komunitas')->constrained('komunitas', 'id_komunitas'); // Ini yang benar
            $table->foreignId('id_bank_sampah')->constrained('bank_sampah', 'id_bank_sampah');
            $table->enum('status_pesanan', ['menunggu', 'diterima', 'ditolak', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->boolean('status_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};

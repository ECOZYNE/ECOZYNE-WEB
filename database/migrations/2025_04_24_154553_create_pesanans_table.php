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
            $table->bigIncrements('id_pesanan');

            $table->unsignedBigInteger('id_komunitas');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');

            $table->unsignedBigInteger('id_bank_sampah');
            $table->foreign('id_bank_sampah')->references('id_bank_sampah')->on('bank_sampah');

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

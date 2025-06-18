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
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id_produk');

            $table->unsignedBigInteger('id_bank_sampah');
            $table->foreign('id_bank_sampah')->references('id_bank_sampah')->on('bank_sampah');

            $table->string('nama_produk'); 
            $table->text('deskripsi'); 
            $table->decimal('harga', 12, 0);
            $table->string('foto'); 
            $table->unsignedInteger('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

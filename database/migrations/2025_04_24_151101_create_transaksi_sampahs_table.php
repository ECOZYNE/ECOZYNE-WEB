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
        Schema::create('transaksi_sampah', function (Blueprint $table) {
            $table->id('id_transaksi_sampah');
            // Pastikan id_komunitas hanya didefinisikan satu kali
            $table->foreignId('id_komunitas')->constrained('komunitas', 'id_komunitas'); // Ini yang benar
            $table->foreignId('id_bank_sampah')->constrained('bank_sampah', 'id_bank_sampah'); // Ini juga perlu dipastikan benar
            $table->decimal('berat_sampah', 8, 2)->unsigned();
            $table->integer('point_didapat')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sampah');
    }
};

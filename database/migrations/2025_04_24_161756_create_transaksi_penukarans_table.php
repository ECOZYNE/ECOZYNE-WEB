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
        Schema::create('transaksi_penukaran', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_penukaran');

            $table->unsignedBigInteger('id_penukaran');
            $table->foreign('id_penukaran')->references('id_penukaran')->on('penukaran');

            $table->unsignedBigInteger('id_hadiah');
            $table->foreign('id_hadiah')->references('id_hadiah')->on('hadiah');

            $table->unsignedInteger('jumlah'); 
            $table->unsignedInteger('point_satuan'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penukaran');
    }
};

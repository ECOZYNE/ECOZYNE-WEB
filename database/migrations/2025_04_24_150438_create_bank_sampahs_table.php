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
        Schema::create('bank_sampah', function (Blueprint $table) {
            $table->bigIncrements('id_bank_sampah');

            $table->unsignedBigInteger('id_pengajuan_bank_sampah');
            $table->foreign('id_pengajuan_bank_sampah')->references('id_pengajuan_bank_sampah')->on('pengajuan_bank_sampah');
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_sampah');
    }
};

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
        Schema::create('jam_operasional', function (Blueprint $table) {
            $table->id('id_operasional');
            $table->unsignedBigInteger('id_bank_sampah');
            $table->string('hari', 20); // Senin, Selasa, dst
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->tinyInteger('is_tutup')->default(0); // 0 = buka, 1 = tutup
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_bank_sampah')
                ->references('id_bank_sampah')
                ->on('bank_sampah')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jam_operasional');
    }
};

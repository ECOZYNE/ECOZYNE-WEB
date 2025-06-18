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
            $table->bigIncrements('id_penukaran');

            $table->unsignedBigInteger('id_komunitas');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');

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

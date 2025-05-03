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
            $table->bigIncrements('id_pendaftaran_kegiatan');

            $table->unsignedBigInteger(column: 'id_komunitas');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');

            $table->unsignedBigInteger(column: 'id_kegiatan');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatans');
    }
};

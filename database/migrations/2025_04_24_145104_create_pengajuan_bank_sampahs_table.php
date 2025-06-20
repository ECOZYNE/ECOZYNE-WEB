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
        Schema::create('pengajuan_bank_sampah', function (Blueprint $table) {
            $table->bigIncrements('id_pengajuan_bank_sampah');

            $table->unsignedBigInteger('id_komunitas');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');

            $table->string('nama_bank_sampah');
            $table->string('file_dokumen');
            $table->text('catatan')->nullable();
            $table->text('lokasi_bank_sampah')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('status', allowed: ['diproses', 'diterima', 'ditolak']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bank_sampah');
    }
};

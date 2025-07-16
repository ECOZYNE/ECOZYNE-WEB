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
        Schema::create('komunitas', function (Blueprint $table) {
        $table->id('id_komunitas');
        $table->foreignId('id_user')->constrained('user', 'id_user'); // Cukup satu ini
        $table->foreignId('id_alamat')->constrained('alamat', 'id_alamat'); // Dan pastikan ini juga tidak duplikat
        $table->string('nama');
        $table->string('no_telp')->unique(); // Pastikan no_telp juga unik seperti di SQL dump
        $table->string('foto');
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};

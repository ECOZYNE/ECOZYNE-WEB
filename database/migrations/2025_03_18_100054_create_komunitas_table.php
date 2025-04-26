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
            $table->bigIncrements('id_komunitas');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');

            $table->unsignedBigInteger('id_alamat');
            $table->foreign('id_alamat')->references('id_alamat')->on('alamat');

            $table->string('nama');
            $table->string('no_telp')->unique();
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

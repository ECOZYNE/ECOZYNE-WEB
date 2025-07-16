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
        Schema::create('point', function (Blueprint $table) {
            $table->id('id_point');
            // Pastikan id_komunitas hanya didefinisikan satu kali
            $table->foreignId('id_komunitas')->constrained('komunitas', 'id_komunitas'); // Ini yang benar
            $table->integer('point')->unsigned();
            $table->date('expired_point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point');
    }
};

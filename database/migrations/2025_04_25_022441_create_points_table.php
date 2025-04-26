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
            $table->bigIncrements('id_point');

            $table->unsignedBigInteger('id_komunitas');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');

            $table->unsignedInteger('point'); 
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

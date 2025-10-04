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
        Schema::create('komik', function (Blueprint $table) {
            $table->id();                          
            $table->string('judul');              
            $table->string('penulis');     
            $table->string('cover');                   
            $table->text('file_pdf');             
            $table->integer('jml_halaman')->default(1);  
            $table->timestamps();                  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komik');
    }
};

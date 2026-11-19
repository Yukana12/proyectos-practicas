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
        Schema::create('carreras_convenios', function (Blueprint $table) {

            $table->foreignId('convenio_id')->constrained('convenios')->cascadeOnDelete(); 
            $table->foreignId('carrera_id')->constrained('carreras')->restrictOnDelete();
            $table->primary(['convenio_id', 'carrera_id']);  

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrera_convenio');
    }
};

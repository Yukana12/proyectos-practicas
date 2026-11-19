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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique(); 
            $table->string('nombre', 100); 
            $table->string('facultad', 100); 
            $table->unsignedTinyInteger('duracion_niveles'); 
            $table->text('descripcion')->nullable(); 
            $table->boolean('activa')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras');
    }
};

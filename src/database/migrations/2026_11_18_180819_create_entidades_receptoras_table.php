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
        Schema::create('entidades_receptoras', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social'); 
            $table->char('ruc', 13)->unique(); 
            $table->string('sector'); 
            $table->string('direccion'); 
            $table->string('ciudad');
            $table->string('contacto_nombre');
            $table->string('contacto_correo');
            $table->string('contacto_telefono', 20);
            $table->string('estado', 20)->default('activa')->index(); 
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidad_receptoras');
    }
};

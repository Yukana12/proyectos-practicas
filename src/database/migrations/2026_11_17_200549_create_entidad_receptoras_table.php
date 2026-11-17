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
        Schema::create('entidad_receptoras', function (Blueprint $table) {
            $table->id();
            $table->char('ruc', 13)->unique(); 
            $table->string('sector'); 
            $table->string('direccion'); 
            $table->string('ciudad'); 
            $table->string('contacto_nombre'); 
            $table->string('contacto_correo'); 
            $table->string('contacto_telefono')->nullable(); 
            $table->string('estado')->default(true); 
            $table->timestamps();
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

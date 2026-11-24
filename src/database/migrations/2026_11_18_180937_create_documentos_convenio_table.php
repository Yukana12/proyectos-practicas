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
        Schema::create('documentos_convenio', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('version'); 
            $table->string('ruta_archivo'); 
            $table->string('nombre_original'); 
            $table->string('mime', 100); 
            $table->unsignedBigInteger('tamano'); 
            $table->char('hash_sha256', 64); 

            //constraints de la tabla
            $table->foreignId('convenio_id')->constrained('convenios')->restrictOnDelete(); 
            $table->foreignId('subido_por')->constrained('users')->restrictOnDelete(); 
            $table->timestamps();

            $table->unique(['convenio_id', 'version']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_convenio');
    }
};

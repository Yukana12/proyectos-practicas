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
    Schema::create('convenios', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique();
        $table->text('objeto');
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->unsignedInteger('cupo_maximo');
        $table->unsignedSmallInteger('horas_por_estudiante');
        $table->string('estado')->default('borrador');
        $table->text('motivo_rescision')->nullable();

        //CONSTRAINT DE LA TABLA
        $table->foreignId('entidad_receptora_id')->constrained('entidades_receptoras')->restrictOnDelete();
        $table->foreignId('convenio_anterior_id')->nullable()->constrained('convenios')->restrictOnDelete();
        $table->foreignId('creado_por')->constrained('users')->restrictOnDelete();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['estado', 'fecha_fin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};

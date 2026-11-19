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
        Schema::create('tutores_empresariales', function (Blueprint $table) {
            $table->id();
            $table->string('cargo')->nullable(); 
            $table->string('telefono', 20)->nullable(); 
            $table->boolean('activo')->default(true); 

            //CONSTRAINTS DE LA TABLA 
            $table->foreignId('entidad_receptora_id')->constrained('entidades_receptoras')->restrictOnDelete(); 
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_empresarials');
    }
};

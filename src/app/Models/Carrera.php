<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Carrera extends Model
{
    // CREAR TABLE EXPLICITO PORQUE LARAVEL PLURAIZA EN INGLES
    protected $table = 'carreras'; 

    protected $fillable = [
        'codigo', 'nombre', 'facultad', 'duracion_niveles', 'descripcion', 'activa', 
    ]; 

    protected function casts(): array{
        return ['activa' => 'boolean']; 
    }

    public function convenios(): BelongsToMany{
        return $this->belongsToMany(convenio::class, 'carreras_convenios'); 
    }

}

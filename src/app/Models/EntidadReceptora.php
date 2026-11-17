<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadReceptora extends Model
{
    //
    protected $table = 'entidades_receptoras'; 

    protected $fillable = [
        'razon_social', 'ruc', 'sector', 'direccion', 'ciudad',
        'contacto_nombre', 'contacto_correo', 'contacto_telefono', 'estado',
    ]; 
}

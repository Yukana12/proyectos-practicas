<?php

namespace App\Models;

use App\Enums\EstadoEntidad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\SoftDeletes; 

class EntidadReceptora extends Model
{
    use SoftDeletes; 

    protected $table = 'entidades_receptoras'; 

    protected $fillable = [
        'razon_social', 'ruc', 'sector', 'direccion', 'ciudad', 'contacto_nombre', 
        'contacto_correo', 'contacto_telefono', 'estado',
    ]; 

    protected function casts(): array{
        return ['estado' => EstadoEntidad::class]; 
    }

    public function convenios(): HasMany{
        return $this->hasMany(Convenio::class, 'entidad_receptora_id'); 
    }

    public function tutoresEmpresariales(): HasMany{ // sirve para
        return $this->hasMany(TutorEmpresarial::class, 'entidad_receptora_id'); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class TutorEmpresarial extends Model
{
    //
    protected $table = 'tutores_empresariales'; 

    protected $fillable = [
        'cargo', 'telefono', 'activo', 'entidad_receptora_id', 'user_id', 
    ]; 

    protected function casts(): array{
        return ['activo' => 'boolean']; 
    }

    public function entidadReceptora(): BelongsTo{
        return $this->belongsTo(EntidadReceptora::class, 'entidad_receptora_id'); 
    }

    public function usuario(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id'); 
    }
}

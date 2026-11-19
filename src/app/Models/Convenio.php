<?php

namespace App\Models;

use App\Enums\EstadoConvenio; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\SoftDeletes; 


class Convenio extends Model
{
    //
    use SoftDeletes; 

    protected $table = 'convenios'; 


    //Estado y motivo de recision quedan fuera a proposito:
    //Solo el sericio del convenio puede cambiarlos, respetando la maquina de estados.

    protected $fillable = [
        'numero', 'objeto', 'fecha_inicio', 'fecha_fin', 'cupo_maximo', 
        'horas_por_estudiante', 
        'entidad_receptora_id', 'convenio_anterior_id', 'creado_por',
    ];

    protected function casts(): array{
        return [
            'fecha_inicio' => 'date', 
            'fecha_fin'    => 'date', 
            'cupo_maximo'  => 'integer',
            'horas_por_estudiante' => 'integer',
            'estado' => EstadoConvenio::class,
        ]; 
    }

    public function entidadReceptora(): BelongsTo{
        return $this->belongsTo(EntidadReceptora::class, 'entidad_receptora_id'); 
    }

    public function convenioAnterior(): BelongsTo{
        return $this->belongsTo(Convenio::class, 'convenio_anterior_id'); 
    }

    public function renovaciones(): HasMany{
        return $this->hasMany(Convenio::class, 'convenio_anterior_id'); 
    }

    public function carreras(): BelongsToMany{
        return $this->belongsToMany(Carrera::class, 'carreras_convenios'); 
    }

    public function documentos(): HasMany{
        return $this->hasMany(DocumentoConvenio::class); 
    }

    public function creador(): BelongsTo{
        return $this->belongsTo(User::class, 'creado_por'); 
    }

    public function scopeVigentes(Builder $query): Builder{
        return $query->where('estado', EstadoConvenio::Vigente->value); 
    }

}

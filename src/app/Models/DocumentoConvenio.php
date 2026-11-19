<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class DocumentoConvenio extends Model
{
    //
    protected $table = 'documentos_convenio'; 
    
    //Los construye el servicio de subida con los datos reales del archivo, 
    //nunca se llena directamente con lo que envia el usuario.
    protected $fillable = [
        'version', 'ruta_archivo', 'nombre_original', 'mime', 'tamano', 
        'hash_sha256', 'convenio_id', 'subido_por', 
    ];

    public function convenio():BelongsTo{
        return $this->belongsTo(Convenio::class, 'convenio_id'); 
    }

    public function subidoPor(): BelongsTo{
        return $this->belongsTo(User::class, 'subido_por'); 
    }
}

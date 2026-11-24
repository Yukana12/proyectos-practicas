<?php

namespace App\Services; 

use App\Enums\EstadoConvenio; 
use App\Models\Convenio; 
use Carbon\CarbonInterface; 
use DomainException; 
use Illuminate\Support\Facades\DB; 

class ConvenioService{

    /**
     * ¿EL convenio permite operar en la fecha dada (por defecto, hoy)¡
     * Lo usan M3 (asignaciones) y m4 (registro de horas)
    */

    public function estaVigente(Convenio $convenio, ?CarbonInterface $fecha = null): bool
    {
        /**
         * exige 2 cosas a la vez que el estado sea vigente y que la fecha de hoy este dentro del rango
         * con ambos extremos incluidos. Así un convenio cuya fecha de fin ya paso deja de valer aunque
         * el estado aun diga vigente y la tarea programada sea ejecutada.
         */
        if ($convenio->estado !== EstadoConvenio::Vigente){
            return false; 
        }

        $dia = ($fecha ?? now())->toDateString(); 

        return $dia >= $convenio->fecha_inicio->toDateString()
        && $dia <= $convenio->fecha_fin->toDateString(); 
    }

    // Cambia el estado respetando la maquina de estado y los requisitos de cada paso
    //@throws DomainEception si el cambio no esta permitido o falta algun requisito

    public function cambiarEstado(
        Convenio $convenio, 
        EstadoConvenio $nuevo, 
        ?string $motivo = null
    ): Convenio{
        $actual = $convenio->estado; 

        if(!$actual->puedePasarA($nuevo)){
            throw new DomainException(
                "No se puede pasar de «{$actual->etiquetas()}» a «{$nuevo->etiquetas()}»."
            ); 
        }

        $this->validarRequisitos($convenio, $nuevo, $motivo); 

        return DB::transaction(function () use($convenio, $nuevo, $motivo){
            //forceFill 'estado' no esta en $fillable a proposito
            //Esto es el unico lugar autorizado para cambiarlo.

            $convenio->forceFill(['estado' => $nuevo]); 
            if($nuevo === EstadoConvenio::Rescindido){
                $convenio->motivo_rescision = $motivo; 
            }

            $convenio->save(); 

            return $convenio; 
        }); 
    }

    public function validarRequisitos(Convenio $convenio, EstadoConvenio $nuevo, 
        ?string $motivo
        ): void{
            if($nuevo === EstadoConvenio::EnRevision && !$convenio->carreras()->exists()){
                throw new DomainException(
                    "Seleciona al menos una carrera antes de enviar a revisión."
                ); 
            }

            if($nuevo === EstadoConvenio::Vigente){
                throw new DomainException(
                    "Cargue el documento firmado antes de enviar el convenio"
                ); 
            }

            if ($convenio->fecha_fin->toDateString() < now()->toDateString()){
                throw new DomainException("La fecha de fin del convenio ya paso"); 
            }

            if ($nuevo === EstadoConvenio::Rescindido && blank($motivo)){
                throw new DomainException(
                    "Debe indicar el motivo de la rescinsión"
                ); 
            }

        }


}
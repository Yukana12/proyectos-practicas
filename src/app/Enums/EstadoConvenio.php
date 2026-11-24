<?php

namespace App\Enums;

enum EstadoConvenio: string
{
    //
    case Borrador   = 'borrador'; 
    case EnRevision = 'en_revision'; 
    case Vigente    = 'vigente'; 
    case Vencido    = 'vencido'; 
    case Rescindido = 'rescindido'; 

    public function etiquetas(): string{
        return match($this){
            self::Borrador      => 'Borrador', 
            self::EnRevision    => 'En renvisión', 
            self::Vigente       => 'Vigente', 
            self::Vencido       => 'Vencido',
            self::Rescindido    => 'rescindido',
        }; 
    }

    //transiciones permitidades desde cada estado
    public function transiciones(): array{
        return match($this){
            self::Borrador      => [self::EnRevision], 
            self::EnRevision    => [self::Borrador, self::Vigente], 
            self::Vigente       => [self::Vencido, self::Rescindido], 
            self::Vencido, self::Rescindido => [],
        }; 
    }

    public function puedePasarA(self $nuevo): bool{
        return in_array($nuevo, $this->transiciones(), true); 
    }
}

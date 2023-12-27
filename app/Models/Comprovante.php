<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comprovante extends Model
{
    use HasFactory;
    
    public function inquilino(): HasOne {
        return $this->hasOne(Inquilino::class, 'inquilino');
    }

    public function tipo_comprovante(): HasOne {
        return $this->hasOne(TipoComprovante::class, 'tipocomprovante');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContaImovel extends Model
{
    use HasFactory;
    protected $table = 'contas_imoveis';

    public function tipo_conta(): HasOne 
    {
        return $this->hasOne(TipoConta::class, 'tipocodigo');
    }

    public function imovel(): HasOne 
    {
        return $this->hasOne(Imovel::class, 'imovelcodigo');
    }

    public function sala(): HasOne {
        return $this->hasOne(Sala::class, 'salacodigo');
    }

}

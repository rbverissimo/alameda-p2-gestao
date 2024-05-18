<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
            'cidade',
            'logradouro',
            'bairro',
            'numero',
            'cep',
            'pontodereferencia',
            'complemento',
            'quadra',
            'lote',
            'uf'
    ];

    public function imovel(): HasOne {
        return $this->hasOne(Imovel::class, 'endereco');
    }
    
}

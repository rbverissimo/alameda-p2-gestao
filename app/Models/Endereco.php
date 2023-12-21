<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
}

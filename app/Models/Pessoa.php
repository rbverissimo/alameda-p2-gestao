<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';

    protected $fillable = [
        'id',
        'nome', 
        'cpf', 
        'profissao', 
        'telefone_celular', 
        'telefone_fixo', 
        'telefone_trabalho'
    ];

    public function inquilino(): HasOne
    {
        return $this->hasOne(Inquilino::class);
    }
}

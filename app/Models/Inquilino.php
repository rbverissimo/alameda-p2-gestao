<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquilino extends Model
{
    use HasFactory;

    protected $table = 'inquilinos';

    protected $fillable = [ 
        'id',
        'valoraluguel',
        'pessoacodigo',
        'imovelcodigo',
        'datacadastro',
        'dataalteracao',
        'situacao'
    ];
}

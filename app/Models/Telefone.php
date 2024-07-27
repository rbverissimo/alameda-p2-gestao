<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $table = 'telefones';

    protected $fillable = [
        'pessoa_id',
        'ddd',
        'telefone',
        'tipo_telefone'
    ];
}

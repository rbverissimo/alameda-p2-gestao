<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo';
    protected $table = 'formas_pagamentos';
    protected $fillable = [
        'codigo',
        'descricao'
    ];
}

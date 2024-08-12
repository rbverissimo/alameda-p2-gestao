<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogErro extends Model
{
    use HasFactory;

    protected $table = 'log_erros';
    protected $fillable = [
        'usuario',
        'log',
        'rota',
        'json',
        'verbo_http',
        'request'
    ];
}

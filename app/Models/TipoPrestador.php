<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestador extends Model
{
    use HasFactory;
    protected $table = 'tipos_prestadores';
    protected $fillable = ['codigoSistema', 'tipo'];
}

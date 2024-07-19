<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TipoPrestador extends Model
{
    use HasFactory;
    protected $table = 'tipos_prestadores';
    protected $fillable = ['codigoSistema', 'tipo'];

    public function prestador(): HasOne
    {
        return $this->hasOne(PrestadorServico::class, 'tipo');
    }
}

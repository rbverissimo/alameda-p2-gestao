<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TipoPrestador extends Model
{
    use HasFactory;
    protected $table = 'tipos_prestadores';
    protected $fillable = ['codigoSistema', 'tipo'];

    public function prestador(): BelongsToMany
    {
        return $this->belongsToMany(PrestadorServico::class, 'prestadores_tipos', 'tipo_id', 'prestador_id');
    }
}

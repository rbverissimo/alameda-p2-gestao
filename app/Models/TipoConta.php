<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoConta extends Model
{
    use HasFactory;
    protected $table = 'tipocontas';

    protected $fillable = [
        'codigo',
        'descricao',
        'sistema',
        'isFatorDivisor'
    ];

    public function imoveis(): BelongsToMany
    {
        return $this->belongsToMany(Imovel::class, 'imoveis_tipos_contas', 'tipoconta', 'imovel');
    }

    public function conta_imovel(): HasMany
    {
        return $this->hasMany(ContaImovel::class, 'tipocodigo');
    }
}

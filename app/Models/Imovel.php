<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imoveis';

    public function endereco(): BelongsTo 
    {
        return $this->belongsTo(Endereco::class, 'endereco');
    }

    public function sala(): HasMany
    {
        return $this->hasMany(Sala::class, 'imovelcodigo');
    }

    public function tipos_contas(): BelongsToMany
    {
        return $this->belongsToMany(TipoConta::class, 'imoveis_tipos_contas', 'imovel', 'tipoconta');
    }
}

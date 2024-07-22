<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrestadorServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function imovel(): BelongsToMany
    {
        return $this->belongsToMany(Imovel::class, 'prestadores_imoveis', 'prestador_id', 'imovel_id');
    }
}

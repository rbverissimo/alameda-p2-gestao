<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrestadorServico extends Model
{
    use HasFactory;

    protected $table = 'prestadores_servicos';

    protected $fillable = [
        'nome', 
        'cpf',
        'cnpj',
        'telefone',
        'endereco'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function imovel(): BelongsToMany
    {
        return $this->belongsToMany(Imovel::class, 'prestadores_imoveis', 'prestador_id', 'imovel_id');
    }

    public function tipo(): BelongsToMany
    {
        return $this->belongsToMany(TipoPrestador::class, 'prestadores_tipos', 'prestador_id', 'tipo_id');
    }
}

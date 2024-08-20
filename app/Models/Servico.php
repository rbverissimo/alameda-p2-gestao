<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
    use HasFactory;
    protected $table = 'servicos';
    protected $fillable = [
        'ud_codigo',
        'ud_nome',
        'descricao',
        'dataFim',
        'dataInicio',
        'valor',
        'salacodigo',
        'tipo_servico'
    ];


    public function sala(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'salacodigo');
    }

    public function prestadores(): BelongsToMany
    {
        return $this->belongsToMany(PrestadorServico::class, 'prestadores_servicos_prestados', 'idServico', 'idPrestador');
    }
}

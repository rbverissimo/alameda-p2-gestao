<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}

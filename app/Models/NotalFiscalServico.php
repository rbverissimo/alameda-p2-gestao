<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotalFiscalServico extends Model
{
    use HasFactory;

    protected $table = 'notas_fiscais_servicos';

    protected $fillable = [
        'servico_id',
        'valorBruto',
        'arquivo_nota_servico',
        'dataEmissao',
        'serie',
        'numeroDocumento',
        'valorISS',
        'baseINSS',
        'valorRetido',
        'aliquota',
        'tipo_servico'
    ];

    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }
}

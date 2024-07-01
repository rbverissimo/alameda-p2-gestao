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
        'descricao',
        'dataFim',
        'dataInicio',
        'valor',
        'imovel'
    ];


    public function imovel(): BelongsTo
    {
        return $this->belongsTo(Imovel::class, 'imovel');
    }
}

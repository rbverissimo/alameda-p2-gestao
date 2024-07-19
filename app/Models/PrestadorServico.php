<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrestadorServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'pessoa_id'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function tipo_prestador(): BelongsTo
    {
        return $this->belongsTo(TipoPrestador::class, 'tipo');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InquilinoAluguel extends Model
{
    use HasFactory;

    protected $table = 'inquilinos_alugueis';
    protected $fillable = ['inquilino', 'valorAluguel', 'inicioValidade', 'fimValidade', 'reajuste_previsto'];


    public function inquilino(): BelongsTo {
        return $this->belongsTo(Inquilino::class, 'inquilino');
    }

}

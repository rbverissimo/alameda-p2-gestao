<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = ['imovelCodigo', 'nomeSala', 'qtdeFamilias', 'qtdeMoradores'];

    public function imovel(): BelongsTo
    {
        return $this->belongsTo(Imovel::class);
    }
}

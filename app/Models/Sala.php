<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = ['imovelcodigo', 'nomeSala', 'qtdeFamilias', 'qtdeMoradores', 'tipo_sala'];

    public function imovel(): BelongsTo
    {
        return $this->belongsTo(Imovel::class, 'imovelcodigo');
    }
}

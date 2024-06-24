<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillabe = [
        'imovel',
        'tipoCompra', 
        'inquilino',
        'dataCompra',
        'valor',
        'descricao'
    ];

    public function fornecedor(): BelongsTo 
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor');
    }

    public function imovel(): BelongsTo
    {
        return $this->belongsTo(Imovel::class, 'imovel');
    }
}

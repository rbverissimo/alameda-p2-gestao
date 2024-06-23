<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';
    protected $fillable = [
        'nome_fornecedor',
        'cnpj',
        'telefone',
        'endereco'
    ];

    public function endereco(): BelongsTo 
    {
        return $this->belongsTo(Endereco::class, 'endereco');
    } 

}

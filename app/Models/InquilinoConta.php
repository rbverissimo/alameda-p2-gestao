<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoConta extends Model
{
    use HasFactory;
    protected $table = 'inquilinos_contas';
    protected $fillable = ['inquilinocodigo', 'contacodigo', 'valorinquilino', 'dataVencimento', 'dataPagamento', 'quitada'];

    public function conta_imovel(): BelongsTo
    {
        return $this->belongsTo(ContaImovel::class, 'contacodigo');
    }

    public function inquilino(): BelongsTo
    {
        return $this->belongsTo(Inquilino::class, 'inquilinocodigo');
    }
}

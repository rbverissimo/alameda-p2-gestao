<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoConta extends Model
{
    use HasFactory;
    protected $table = 'inquilinos_contas';
    protected $fillable = ['inquilinocodigo', 'contacodigo', 'valorinquilino', 'dataVencimento', 'dataPagamento', 'quitada'];

    public function conta_imovel(): HasOne
    {
        return $this->hasOne(ContaImovel::class, 'contacodigo');
    }

    public function inquilino(): HasOne
    {
        return $this->hasOne(Inquilino::class, 'inquilinocodigo');
    }
}

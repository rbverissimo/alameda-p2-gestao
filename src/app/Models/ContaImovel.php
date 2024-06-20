<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContaImovel extends Model
{
    use HasFactory;
    protected $table = 'contas_imoveis';

    protected $fillable = ['valor', 'imovelcodigo', 'ano', 'mes', 'dataVencimento', 'observacoes', 'referenciaConta', 'nrDocumento', 'salaCodigo', 'tipocodigo', 'arquivo_conta'];

    public function tipo_conta(): HasOne 
    {
        return $this->hasOne(TipoConta::class, 'tipocodigo');
    }

    public function sala(): HasOne {
        return $this->hasOne(Sala::class, 'salacodigo');
    }



}

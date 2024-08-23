<?php

namespace App\Models;

use App\ValueObjects\PessoaVO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Inquilino extends Model
{
    use HasFactory;
    protected $fillable = ['situacao', 
        'salacodigo', 
        'qtdePessoasFamilia', 
        'nome', 
        'cpf', 
        'endereco_trabalho', 
        'profissao'];

    public function sala(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'salacodigo');
    }

    public function contas(): HasMany
    {
        return $this->hasMany(InquilinoConta::class, 'inquilinocodigo');
    }

    public function fator_divisor(): HasOne 
    {
        return $this->hasOne(InquilinoFatorDivisor::class, 'inquilino_id');
    }

    public function saldo(): HasOne 
    {
        return $this->hasOne(InquilinoSaldo::class, 'inquilinocodigo');
    }

    public function aluguel(): hasMany 
    {
        return $this->hasMany(InquilinoAluguel::class, 'inquilino');
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoacodigo');
    }

    public function telefone(): BelongsToMany
    {
        return $this->belongsToMany(Telefone::class, 'inquilinos_telefones', 'inquilino_id', 'telefone_id');
    }

}

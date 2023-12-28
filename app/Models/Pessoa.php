<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pessoa extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cpf', 'profissão',
        'telefone_celular', 'telefone_fixo', 'telefone_trabalho'];
    
    public function inquilino(): BelongsTo {
        return $this->belongsTo(Inquilino::class);
    }
}

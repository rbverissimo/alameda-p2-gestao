<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imoveis';

    public function endereco(): HasOne 
    {
        return $this->hasOne(Endereco::class, 'endereco');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoSaldo extends Model
{
    use HasFactory;

    protected $table = 'inquilinos_saldo';

    public function inquilino(): HasOne
    {
        return $this->hasOne(Inquilino::class, 'inquilinocodigo');
    }
}

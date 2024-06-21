<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoSaldo extends Model
{
    use HasFactory;

    protected $table = 'inquilinos_saldo';

    public function inquilino(): BelongsTo
    {
        return $this->belongsTo(Inquilino::class, 'inquilinocodigo');
    }
}

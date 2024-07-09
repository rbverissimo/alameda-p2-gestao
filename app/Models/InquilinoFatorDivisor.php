<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoFatorDivisor extends Model
{
    use HasFactory;

    protected $table = 'inquilinos_fator_divisor';
    
    protected $fillable = [
        'inquilino_id',
        'fatorDivisor'
    ];

    public function inquilino(): BelongsTo {
        return $this->belongsTo(Inquilino::class, 'inquilino_id');
    }
}

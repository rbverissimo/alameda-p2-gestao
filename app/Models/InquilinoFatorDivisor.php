<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InquilinoFatorDivisor extends Model
{
    use HasFactory;

    public function inquilino(): HasOne {
        return $this->hasOne(Inquilino::class, 'inquilino_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inquilino extends Model
{
    use HasFactory;

    public function sala(): HasOne
    {
        return $this->hasOne(Sala::class, 'salacodigo');
    }
}

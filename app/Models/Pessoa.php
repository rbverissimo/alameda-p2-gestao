<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
    use HasFactory;

    public function telefones(): HasMany
    {
        return $this->hasMany(Telefone::class, 'pessoa_id');
    }
    
}

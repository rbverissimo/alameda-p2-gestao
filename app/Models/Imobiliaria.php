<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Imobiliaria extends Model
{
    use HasFactory;

    protected $table = 'imobiliarias';
    protected $fillable = ['nome', 'usuario_id'];

    public function imoveis(): HasMany
    {
        return $this->hasMany(Imovel::class, 'imobiliaria_id');
    }
}

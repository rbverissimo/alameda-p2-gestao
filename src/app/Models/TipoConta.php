<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TipoConta extends Model
{
    use HasFactory;
    protected $table = 'tipocontas';


    public function imoveis(): BelongsToMany
    {
        return $this->belongsToMany(Imovel::class, 'imoveis_tipos_contas', 'tipoconta', 'imovel');
    }
}

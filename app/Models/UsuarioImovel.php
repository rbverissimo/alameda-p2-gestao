<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuarioImovel extends Model
{
    use HasFactory;

    protected $table = 'users_imoveis';

    protected $fillable = ['idUsuario', 'idImovel'];

    public function imoveis(): BelongsTo {
        return $this->belongsTo(Imovel::class, 'idImovel');
    }
}

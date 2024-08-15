<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TipoSala extends Model
{
    use HasFactory;
    protected $table = 'tipos_sala';
    protected $fillable = [ 'id', 'descricao', 'sistema'];


    public function sala(): HasOne
    {
        return $this->hasOne(Sala::class, 'tipo_sala');
    }
    
}

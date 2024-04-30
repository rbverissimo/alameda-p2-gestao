<?php

namespace App\Services;

use App\Models\TipoConta;

class TipoContasService {

    public static function getDescricaoTipoContaBy($id){
        return TipoConta::where('id', $id)->value('descricao');
    }

    public static function getCodigoTipoContaBy($id){
        return TipoConta::where('id', $id)->value('codigo');
    }
}
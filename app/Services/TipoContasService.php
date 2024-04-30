<?php

namespace App\Services;

use App\Models\TipoConta;

class TipoContasService {

    public static function getDescricaoTipoContaBy($id){
        return TipoConta::find($id)->pluck('descricao')->first();
    }

    public static function getCodigoTipoContaBy($id){
        return TipoConta::find($id)->pluck('codigo')->first();
    }
}
<?php

namespace App\Services;

use App\Models\TipoServico;

class TiposServicosService {

    public static function getListaTiposServicos(){
        return TipoServico::all();
    }

}
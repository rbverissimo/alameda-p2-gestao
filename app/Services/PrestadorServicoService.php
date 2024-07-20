<?php

namespace App\Services;

use App\Models\TipoPrestador;

class PrestadorServicoService {



    public static function getListaTiposPrestadores()
    {
        return TipoPrestador::all();
    }

}
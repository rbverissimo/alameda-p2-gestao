<?php

namespace App\Services;

use App\Models\ContaImovel;

class CalculoContasService {

    public function calcularContasInquilinos(){

        $conta_agua = ContaImovel::max('referenciaConta')->where('tipocodigo', 1);
    }

}

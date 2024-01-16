<?php

namespace App\Services;

use App\Models\ContaImovel;

class CalculoContasService {

    public function calcularContasInquilinos(){

        $conta_agua = ContaImovel::where('tipocodigo', 1)->orderByDesc('id')->limit(1);

        $conta_luz_sala1 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 1)->orderByDesc('id')->limit(1)->get();

        $conta_luz_sala2 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 2)->orderByDesc('id')->limit(1)->get();

        $conta_luz_sala3 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 3)->orderByDesc('id')->limit(1)->get();
    }

}

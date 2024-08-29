<?php

namespace App\Services;

use App\Models\TipoServico;
use App\ValueObjects\SelectOptionVO;

class TiposServicosService {

    public static function getListaTiposServicos(){
        $tipos_servicos = TipoServico::all();

        $options = [SelectOptionVO::getPrimeiroElementoVazio()];
        foreach ($tipos_servicos as $tipo) {
            $vo = new SelectOptionVO($tipo->codigo, $tipo->tipo);
            $options[] = $vo->getJson();
        }
        return $options;
    }

}
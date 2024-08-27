<?php

namespace App\Models\BusinessObjects;

use App\Services\TelefonesService;
use App\ValueObjects\SelectOptionVO;

class TelefonesBO {


    /**
     * Este método retorna uma lista de options contendo código e tipo de telefone 
     * para um select no front-end da aplicação
     */
    public function getListaSelect(){
        $registros = TelefonesService::getTipos();
        $selectOptions[] = [SelectOptionVO::getPrimeiroElementoVazio()]; 
        foreach($registros as $tel){
            $vo = new SelectOptionVO($tel->codigo, $tel->tipo);
            $selectOptions[] = $vo->getJson();
        }
        return $selectOptions;
    }
}
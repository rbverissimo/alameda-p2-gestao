<?php

namespace App\Models\BusinessObjects;

use App\Http\Dto\LogErroDTO;
use App\Http\Dto\RequestParamsDTO;
use App\Services\LogErrosService;
use App\Services\UsuarioService;

class LogErrosBO {

    private LogErroDTO $dto;

    public function __construct(RequestParamsDTO $request_params , $mensagem) {

        $this->dto = new LogErroDTO(UsuarioService::getUsuarioLogado(), 
            $request_params->getUrl(), 
            json_encode($request_params->getInputs()), 
            $mensagem, 
            $request_params->getMetodo(),
             json_encode($request_params->getHeaders()));
    }

    public function salvar(){
        LogErrosService::salvarErro($this->dto);
    }

}
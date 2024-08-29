<?php

namespace App\Models\BusinessObjects;

use App\Http\Dto\LogErroDTO;
use App\Http\Dto\RequestParamsDTO;
use App\Services\LogErrosService;
use App\Services\UsuarioService;
use Throwable;

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

    /**
     * Este método é um caminho mais curto para cadastrar um erro passando apenas a requisição e a exception.
     * No cliente, é necessário fazer um new RequestParamsDTO($request) passando-o no parâmetro desse método.
     * 
     * @return void
     */
    public static function salvarErros(RequestParamsDTO $request_params, Throwable $th): void
    {
        $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
        $log_erros_bo->salvar();
    }

}
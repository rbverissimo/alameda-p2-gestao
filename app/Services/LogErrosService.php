<?php

namespace App\Services;

use App\Http\Dto\LogErroDTO;
use App\Models\LogErro;

class LogErrosService {


    public static function salvarErro(LogErroDTO $dto){
        try{
            LogErro::create([
               'usuario' => $dto->getUsuario(),
               'json' => $dto->getJson(),
               'rota' => $dto->getRota(),
               'verbo_http' => $dto->getVerboHttp(),
               'request' => $dto->getRequest(),
               'log' => $dto->getLog() 
            ]);

        } catch(\Throwable $e) {
            throw $e;
        }
    }

    public static function salvarErrosPassandoParametrosManuais($rota, $log, $json, $verbo_http = null, $headers = null){
        try {
            $usuario = UsuarioService::getUsuarioLogado();
            LogErro::create([
                'usuario' => $usuario,
                'rota' => $rota,
                'log' => $log,
                'json' => $json,
                'verbo_http' => $verbo_http,
                'request' => $headers
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

}
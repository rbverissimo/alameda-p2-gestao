<?php

namespace App\Models\BusinessObjects;

use App\Http\Dto\LogErroDTO;

class LogErrosBO {

    public static function validar(LogErroDTO $dto): LogErroDTO
    {
        $json = $dto->getJson();
        $dto->setJson(json_encode($json));

        $request_headers = $dto->getRequest();
        $dto->setRequest(json_encode($request_headers));

        return $dto;
    }

}
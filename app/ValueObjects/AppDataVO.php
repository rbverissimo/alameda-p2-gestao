<?php

namespace App\ValueObjects;

class  AppDataVO {

    private string $dominio;
    private array $appData;

    public function __construct(string $dominio, array $appData) {
        $this->dominio = $dominio;
        $this->appData = $appData;
    }

    public function getJson(){
        return [
            'dominio' => $this->dominio,
            'appData' => $this->appData
        ];
    }

}
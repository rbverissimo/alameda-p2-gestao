<?php

namespace App\ValueObjects;

class DescricaoValorContaVO {

    private string $descricao;
    private float $valor;

    public function __construct(string $descricao, float $valor) {
        $this->descricao =$descricao;
        $this->valor = $valor;
    }

    public function getJson(){
        return [
            'descricao' => $this->descricao,
            'valor' => $this->valor 
        ];
    }
}
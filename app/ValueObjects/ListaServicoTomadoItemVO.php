<?php

namespace App\ValueObjects;

class ListaServicoTomadoItemVO {

    private string $nome;
    private float $valor; 

    public function __construct(string $nome, float $valor) {
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }
    
}
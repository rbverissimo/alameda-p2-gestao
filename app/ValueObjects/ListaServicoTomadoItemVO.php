<?php

namespace App\ValueObjects;

class ListaServicoTomadoItemVO {

    private int $id;
    private string $nome;
    private float $valor; 

    public function __construct(int $id, string $nome, float $valor) {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function getId(): int 
    {
        return $this->id;
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
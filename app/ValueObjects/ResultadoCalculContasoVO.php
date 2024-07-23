<?php

namespace App\ValueObjects;

class ResultadoCalculoContasVO {

    private string $nome;
    private float $valorAluguel;
    private float $total;
    private array $contas;

    public function __construct(string $nome, float $valorAluguel, float $total, array $contas) {
        $this->nome = $nome;
        $this->valorAluguel = $valorAluguel;
        $this->total = $total;
        $this->contas = $contas;
    }

    

}
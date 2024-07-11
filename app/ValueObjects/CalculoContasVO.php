<?php

namespace App\ValueObjects;

class CalculoContasVO {

    private int $sala;
    private array $inquilinos;
    private array $contas_sala;

    public function __construct(int $sala, array $inquilinos, $contas_sala) {
        $this->sala = $sala;
        $this->inquilinos = $inquilinos;
        $this->contas_sala = $contas_sala;
    }

    public function getSala(): int
    {
        return $this->sala;
    }

    public function getInquilinos(): array
    {
        return $this->inquilinos;
    }

    public function getContasSala(): array
    {
        return $this->contas_sala;
    }

    public function setSala(int $sala): void
    {
        $this->sala = $sala;
    }

    public function setInquilinos(array $inquilinos): void
    {
        $this->inquilinos = $inquilinos;
    }

    public function setContasSala(array $contasSala): void
    {
        $this->contas_sala = $contasSala;
    }

    public function getJson(){
        return [
            'sala' => $this->sala,
            'inquilinos' => $this->inquilinos,
            'contas' => $this->contas_sala,
        ];
    }

}
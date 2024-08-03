<?php

namespace App\Http\Dto;

class TelefoneDTO {

    private string $ddd;
    private string $telefone;
    private int $tipo;

    public function getDdd(): string {
        return $this->ddd;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getTipo(): int {
        return $this->tipo;
    }
 
    public function setDdd(string $ddd): void {
        $this->ddd = $ddd;
    }

    public function setTelefone(string $telefone): void {
        $this->telefone = $telefone;
    }

    public function setTipo(int $tipo): void {
        $this->tipo = $tipo;
    }    

}
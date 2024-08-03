<?php

namespace App\Http\Dto;

class TelefoneDTOBuilder {

    private TelefoneDTO $telefone_dto;

    public function __construct() {
        $this->telefone_dto = new TelefoneDTO();
    }

    public function withDdd(string $ddd): TelefoneDTOBuilder
    {
        $this->telefone_dto->setDdd($ddd);
        return $this;
    }

    public function withTelefone(string $telefone): TelefoneDTOBuilder
    {
        $this->telefone_dto->setTelefone($telefone);
        return $this;
    }

    public function withTipo(int $tipo): TelefoneDTOBuilder
    {
        $this->telefone_dto->setTipo($tipo);
        return $this;
    }

    public function build(): TelefoneDTO
    {
        return $this->telefone_dto;
    }
}
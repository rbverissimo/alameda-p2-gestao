<?php

namespace App\Http\Dto;

class SalaDTOBuilder {

    private SalaDTO $salaDTO;

    public function __construct() {
        $this->salaDTO = new SalaDTO();
    }

    public function withIdImovel(int $idImovel): SalaDTOBuilder {
        $this->salaDTO->setIdImovel($idImovel);
        return $this;
    }
    
    public function withNomeSala(string $nomeSala): SalaDTOBuilder {
        $this->salaDTO->setNomeSala($nomeSala);
        return $this;
    }

    public function withTipoSala(int $tipoSala): SalaDTOBuilder {
        $this->salaDTO->setTipoSala($tipoSala);
        return $this;
    }

    public function build(): SalaDTO{
        return $this->salaDTO;
    }
}
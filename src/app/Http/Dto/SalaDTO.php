<?php

namespace App\Http\Dto;

class SalaDTO {


    private $nomeSala;
    private $tipoSala;
    private $idImovel;

    // Getters
  public function getNomeSala() {
    return $this->nomeSala;
  }

  public function getTipoSala() {
    return $this->tipoSala;
  }

  public function getIdImovel() {
    return $this->idImovel;
  }

  // Setters
  public function setNomeSala($nomeSala) {
    $this->nomeSala = $nomeSala;
  }

  public function setTipoSala($tipoSala) {
    $this->tipoSala = $tipoSala;
  }

  public function setIdImovel($idImovel) {
    $this->idImovel = $idImovel;
  }

}
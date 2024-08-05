<?php

namespace App\ValueObjects;

class PrestadorTipoVO {

    private string $codigoSistema;
    private string $tipo; 

    public function __construct(string $codigoSistema, string $tipo) {
        $this->codigoSistema = $codigoSistema;
        $this->tipo = $tipo;
    }

    public function getCodigo(): string
    {
        return $this->codigoSistema;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigoSistema = $codigo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getJson(){
        return [
            'codigo' => $this->codigoSistema,
            'tipo' => $this->tipo
        ];
    }

} 
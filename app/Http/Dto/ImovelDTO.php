<?php

namespace App\Http\Dto;

class ImovelDTO {

    private string $cep;
    private string $logradouro;
    private string $bairro;
    private int $numero;
    private int $quadra;
    private int $lote;
    private string $complemento;
    private string $nomefantasia; 
    
    public function __construct(string $cep, string $logradouro, string $bairro, int $numero, int $quadra, int $lote,
                                string $complemento, string $nomefantasia) {
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->quadra = $quadra;
        $this->lote = $lote;
        $this->complemento = $complemento;
        $this->nomefantasia = $nomefantasia;
    }

    // Getters
    public function getCep(): string
    {
        return $this->cep;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getQuadra(): int
    {
        return $this->quadra;
    }

    public function getLote(): int
    {
        return $this->lote;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function getNomeFantasia(): string
    {
        return $this->nomefantasia;
    }

    // Setters
    public function setCep(string $cep): void
    {
        $this->cep = $cep;
    }

    public function setLogradouro(string $logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function setQuadra(int $quadra): void
    {
        $this->quadra = $quadra;
    }

    public function setLote(int $lote): void
    {
        $this->lote = $lote;
    }

    public function setComplemento(string $complemento): void
    {
        $this->complemento = $complemento;
    }

    public function setNomeFantasia(string $nomefantasia): void
    {
        $this->nomefantasia = $nomefantasia;
    }
    
}
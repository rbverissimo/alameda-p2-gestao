<?php

namespace App\Http\Dto;

class EnderecoDTO {

    private string $cidade;
    private ?string $logradouro;
    private string $uf;
    private string $bairro;
    private int $numero;
    private ?int $quadra;
    private ?int $lote; 
    private string $cep;
    private ?string $complemento;


    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getQuadra(): ?int
    {
        return $this->quadra;
    }

    public function getLote(): ?int
    {
        return $this->lote;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }


    public function setCidade(string $cidade)
    {
        $this->cidade = $cidade;
    }

    public function setLogradouro(?string $logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function setUf(string $uf)
    {
        $this->uf = $uf;
    }

    public function setBairro(string $bairro)
    {
        $this->bairro = $bairro;
    }

    public function setNumero(int $numero)
    {
        $this->numero = $numero;
    }


    public function setQuadra(?int $quadra)
    {
        $this->quadra = $quadra;
    }

    public function setLote(?int $lote)
    {
        $this->lote = $lote;
    }

    public function setCep(string $cep)
    {
        $this->cep = $cep;
    }

    public function setComplemento(?string $complemento): void 
    {
        $this->complemento = $complemento;
    }

}
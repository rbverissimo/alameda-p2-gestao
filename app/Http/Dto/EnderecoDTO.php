<?php

namespace App\Http\Dto;

class EnderecoDTO {

    private string $cidade;
    private string $logradouro;
    private string $uf;
    private string $bairro;
    private int $numero;
    private int $quadra;
    private int $lote; 
    private string $cep;


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

    public function getQuadra(): int
    {
        return $this->quadra;
    }

    public function getLote(): int
    {
        return $this->lote;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function setLogradouro(string $logradouro): self
    {
        $this->logradouro = $logradouro;
        return $this;
    }


    public function setUf(string $uf): self
    {
        $this->uf = $uf;
        return $this;
    }

    public function setBairro(string $bairro): self
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;
        return $this;
    }


    public function setQuadra(int $quadra): self
    {
        $this->quadra = $quadra;
        return $this;
    }

    public function setLote(int $lote): self
    {
        $this->lote = $lote;
        return $this;
    }

    public function setCep(string $cep): self
    {
        $this->cep = $cep;
        return $this;
    }
}
<?php

namespace App\Http\Dto;

class ImovelDTO {

    private string $cidade;
    private string $uf;
    private string $cep;
    private string $logradouro;
    private string $bairro;
    private int $numero;
    private int $quadra;
    private int $lote;
    private string $complemento;
    private string $nomefantasia; 
    private ?string $cnpj;
    private int $usuario;

    // Getters
    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

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

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function getUsuario(): int 
    {
        return $this->usuario;
    }

    // Setters
    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function setUf(string $uf): void
    {
        $this->uf = $uf;
    }

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

    public function setCnpj(?string $cnpj): void 
    {
        $this->cnpj = $cnpj;
    }

    public function setUsuario(int $usuario): void 
    {
        $this->usuario = $usuario; 
    }

}
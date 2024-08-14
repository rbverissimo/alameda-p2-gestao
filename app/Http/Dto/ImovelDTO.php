<?php

namespace App\Http\Dto;

class ImovelDTO {

    private int $imobiliaria;
    private string $nomefantasia; 
    private ?string $cnpj;
    private EnderecoDTO $endereco;

    //Getters

    public function getImobiliaria(): int 
    {
        return $this->imobiliaria;
    }

    public function getNomeFantasia(): string
    {
        return $this->nomefantasia;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function getEndereco(): EnderecoDTO
    {
        return $this->endereco;
    }

    // Setters
    public function setImobiliaria(int $imobiliaria): void 
    {
        $this->imobiliaria = $imobiliaria;
    }

    public function setNomeFantasia(string $nomefantasia): void
    {
        $this->nomefantasia = $nomefantasia;
    }

    public function setCnpj(?string $cnpj): void 
    {
        $this->cnpj = $cnpj;
    }

    public function setEndereco(EnderecoDTO $endereco): void 
    {
        $this->endereco = $endereco;
    }

}
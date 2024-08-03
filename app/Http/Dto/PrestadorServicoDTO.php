<?php

namespace App\Http\Dto;

class PrestadorServicoDTO {


    private string $nome;
    private ?string $cpf;
    private ?string $cnpj;
    private TelefoneDTO $telefone;
    private ?EnderecoDTO $endereco;
    private array $tipos;
    private int $imobiliaria;

    public function getNome(): string {
        return $this->nome;
    }

    public function getCpf(): ?string {
        return $this->cpf;
    }

    public function getCnpj(): ?string {
        return $this->cnpj;
    }

    public function getTelefone(): TelefoneDTO {
        return $this->telefone;
    }

    public function getEndereco(): ?EnderecoDTO 
    {
        return $this->endereco;
    }
    public function getTipos(): array
    {
        return $this->tipos;
    }

    public function getImobiliaria(): int
    {
        return $this->imobiliaria;
    }
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setCpf(?string $cpf): void {
        $this->cpf = $cpf;
    }

    public function setCnpj(?string $cnpj): void {
        $this->cnpj = $cnpj;
    }

    public function setTelefone(TelefoneDTO $telefone): void {
        $this->telefone = $telefone;
    }

    public function setEndereco(?EnderecoDTO $endereco): void {
        $this->endereco = $endereco;
    }

    public function setTipos(array $tipos): void
    {
        $this->tipos = $tipos;
    }

    public function setImobiliaria(int $imobiliaria): void
    {
        $this->imobiliaria = $imobiliaria;
    }


}
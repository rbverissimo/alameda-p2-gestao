<?php

namespace App\ValueObjects;

class InquilinoVO {

    private string $nome;
    private ?string $cpf;

    /**
     * @var array [ 'telefone' => (62)99898-0001, 'tipo' => 1]
     */
    private array $telefones;
    private ?EnderecoVO $endereco_trabalho;

    private string $imobiliaria;
    /**
     * @var int id do App\Models\Imovel
     */
    private string $imovel;
    private string $sala;
    private ?float $fator_divisor;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function getEnderecoTrabalho(): ?EnderecoVO
    {
        return $this->endereco_trabalho;
    }

    public function getImobiliaria(): string
    {
        return $this->imobiliaria;
    }

    public function getImovel(): string
    {
        return $this->imovel;
    }

    public function getSala(): string
    {
        return $this->sala;
    }

    public function getFatorDivisor(): float
    {
        return $this->fator_divisor;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function setTelefones(array $telefones): void
    {
        $this->telefones = $telefones;
    }

    public function setEnderecoTrabalho(?EnderecoVO $enderecoTrabalho): void
    {
        $this->endereco_trabalho = $enderecoTrabalho;
    }

    public function setImobiliaria(string $imobiliaria): void
    {
        $this->imobiliaria = $imobiliaria;
    }

    public function setImovel(string $imovel): void
    {
        $this->imovel = $imovel;
    }

    public function setSala(string $sala): void
    {
        $this->sala = $sala;
    }

    public function setFatorDivisor(?float $fatorDivisor): void
    {
        $this->fator_divisor = $fatorDivisor;
    }


    public function getJson(){
        return [
            'nome' => $this->nome,
            'cpf' => $this->cpf, 
            'fator_divisor' => $this->fator_divisor,
            'telefones' => $this->telefones,
            'endereco_trabalho' => $this->endereco_trabalho->getJson()
        ];
    }
}
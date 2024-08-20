<?php

namespace App\ValueObjects;

class InquilinoVO {

    private string $nome;
    private string $cpf;

    /**
     * @var array de App\Models\Telefone
     */
    private array $telefones;
    private ?EnderecoVO $endereco_trabalho;

    /**
     * @var int id do App\Models\Imovel
     */
    private int $imovel;
    private float $fator_divisor;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
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

    public function getImovel(): int
    {
        return $this->imovel;
    }

    public function getFatorDivisor(): float
    {
        return $this->fator_divisor;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf): void
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

    public function setImovel(int $imovel): void
    {
        $this->imovel = $imovel;
    }

    public function setFatorDivisor(float $fatorDivisor): void
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
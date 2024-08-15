<?php 

namespace App\Http\Dto;

class ServicoDTO {

    private int $codigo;
    private string $nome;
    private float $valor;
    private string $dataInicio;
    private string $dataFim;
    private ?string $descricao;
    private int $sala;
    private int $tipo;
    private array $prestadores;

    // Getters
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getDataInicio(): string
    {
        return $this->dataInicio;
    }

    public function getDataFim(): string
    {
        return $this->dataFim;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function getSala(): int
    {
        return $this->sala;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function getPrestadores(): array
    {
        return $this->prestadores;
    }

    // Setters
    public function setCodigo(int $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function setDataInicio(string $dataInicio): void
    {
        $this->dataInicio = $dataInicio;
    }

    public function setDataFim(string $dataFim): void
    {
        $this->dataFim = $dataFim;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setSala(int $sala): void
    {
        $this->sala = $sala;
    }

    public function setTipo(int $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function setPrestadores(array $prestadores): void
    {
        $this->prestadores = $prestadores;
    }    
}
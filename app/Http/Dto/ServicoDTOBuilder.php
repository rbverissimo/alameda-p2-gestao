<?php

namespace App\Http\Dto;

class ServicoDTOBuilder {

    private ServicoDTO $dto;

    public function __construct() {
        $this->dto = new ServicoDTO();
    }

    public function withCodigo(int $codigo): self
    {
        $this->dto->setCodigo($codigo);
        return $this;
    }

    public function withNome(string $nome): self
    {
        $this->dto->setNome($nome);
        return $this;
    }

    public function withValor(float $valor): self
    {
        $this->dto->setValor($valor);
        return $this;
    }

    public function withDataInicio(string $dataInicio): self
    {
        $this->dto->setDataInicio($dataInicio);
        return $this;
    }

    public function withDataFim(string $dataFim): self
    {
        $this->dto->setDataFim($dataFim);
        return $this;
    }

    public function withDescricao(?string $descricao): self
    {
        $this->dto->setDescricao($descricao);
        return $this;
    }

    public function withSala(int $sala): self
    {
        $this->dto->setSala($sala);
        return $this;
    }

    public function withTipo(int $tipo): self
    {
        $this->dto->setSala($tipo);
        return $this;
    }

    public function withPrestadores(array $prestadores): self
    {
        $this->dto->setPrestadores($prestadores);
        return $this;
    }

    public function build(): ServicoDTO
    {
        return $this->dto;
    }

}
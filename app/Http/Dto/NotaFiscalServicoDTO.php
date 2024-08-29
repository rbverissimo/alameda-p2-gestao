<?php

namespace App\Http\Dto;

class NotaFiscalServicoDTO {

    private float $valorBruto;
    private string $arquivo;
    private int $servico;
    private string $dataEmissao;
    private ?string $serie;
    private string $numeroDocumento;
    private ?float $valorISS;
    private ?float $baseISS;
    private ?float $valorRetido;
    private ?float $aliquota;
    private int $tipoServico;
    
    // Getters
    public function getValorBruto(): float
    {
        return $this->valorBruto;
    }

    public function getArquivo(): string
    {
        return $this->arquivo;
    }

    public function getServico(): int
    {
        return $this->servico;
    }

    public function getDataEmissao(): string
    {
        return $this->dataEmissao;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function getNumeroDocumento(): string
    {
        return $this->numeroDocumento;
    }

    public function getValorISS(): ?float
    {
        return $this->valorISS;
    }

    public function getBaseISS(): ?float
    {
        return $this->baseISS;
    }

    public function getValorRetido(): ?float
    {
        return $this->valorRetido;
    }

    public function getAliquota(): ?float
    {
        return $this->aliquota;
    }

    public function getTipoServico(): int
    {
        return $this->tipoServico;
    }

    // Setters
    public function setValorBruto(float $valorBruto): void
    {
        $this->valorBruto = $valorBruto;
    }

    public function setArquivo(string $arquivo): void
    {
        $this->arquivo = $arquivo;
    }

    public function setServico(int $servico): void
    {
        $this->servico = $servico;
    }

    public function setDataEmissao(string $dataEmissao): void
    {
        $this->dataEmissao = $dataEmissao;
    }

    public function setSerie(?string $serie): void
    {
        $this->serie = $serie;
    }

    public function setNumeroDocumento(string $numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
    }

    public function setValorISS(?float $valorISS): void
    {
        $this->valorISS = $valorISS;
    }

    public function setBaseISS(?float $baseISS): void
    {
        $this->baseISS = $baseISS;
    }

    public function setValorRetido(?float $valorRetido): void
    {
        $this->valorRetido = $valorRetido;
    }

    public function setAliquota(?float $aliquota): void
    {
        $this->aliquota = $aliquota;
    }

    public function setTipoServico(int $tipoServico): void
    {
        $this->tipoServico = $tipoServico;
    }
}
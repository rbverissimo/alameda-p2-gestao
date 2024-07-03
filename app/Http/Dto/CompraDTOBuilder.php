<?php

namespace App\Http\Dto;

class CompraDTOBuilder {

    private  CompraDTO $compra_dto;

    public function __construct() {
        $this->compra_dto = new CompraDTO();
    }


    public function withIdFornecedor(int $idFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setIdFornecedor($idFornecedor);
        return $this;
    }
    
    public function withImovelCompra(int $imovelCompra): CompraDTOBuilder
    {
        $this->compra_dto->setImovelCompra($imovelCompra);
        return $this;
    }

    public function withTipoCompra(int $tipoCompra): CompraDTOBuilder
    {
        $this->compra_dto->setTipoCompra($tipoCompra);
        return $this;
    }

    public function withQtdeParcelas(int $qtdeParcelas): CompraDTOBuilder
    {
        $this->compra_dto->setQtdeParcelas($qtdeParcelas);
        return $this;
    }

    public function withDataCompra(string $dataCompra): CompraDTOBuilder
    {
        $this->compra_dto->setDataCompra($dataCompra);
        return $this;
    }

    public function withValorCompra(float $valorCompra): CompraDTOBuilder
    {
        $this->compra_dto->setValorCompra($valorCompra);
        return $this;
    }

    public function withDescricao(string $descricao): CompraDTOBuilder
    {
        $this->compra_dto->setDescricao($descricao);
        return $this;
    }

    public function withNota(string $nota): CompraDTOBuilder
    {
        $this->compra_dto->setNota($nota);
        return $this;
    }

    public function withNrDocumentoNota(string $nrDocumentoNota): CompraDTOBuilder
    {
        $this->compra_dto->setNrDocumentoNota($nrDocumentoNota);
        return $this;
    }

    public function withGarantia(string $garantia): CompraDTOBuilder
    {
        $this->compra_dto->setGarantia($garantia);
        return $this;
    }

    public function withQtdeDiasGarantia(int $qtdeDiasGarantia): CompraDTOBuilder
    {
        $this->compra_dto->setQtdeDiasGarantia($qtdeDiasGarantia);
        return $this;
    }

    public function withNomeVendedor(string $nomeVendedor): CompraDTOBuilder
    {
        $this->compra_dto->setNomeVendedor($nomeVendedor);
        return $this;
    }

    public function withFormaPagamento(int $formaPagamento): CompraDTOBuilder
    {
        $this->compra_dto->setFormaPagamento($formaPagamento);
        return $this;
    }


    
    public function build(): CompraDTO {
        return $this->compra_dto;
    }

}
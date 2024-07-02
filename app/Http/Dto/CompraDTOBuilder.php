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

    public function withCnpjFornecedor(string $cnpjFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setCnpjFornecedor($cnpjFornecedor);
        return $this;
    }

    public function withTelefoneFornecedor(string $telefoneFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setTelefoneFornecedor($telefoneFornecedor);
        return $this;
    }

    public function withNomeFornecedor(string $nomeFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setNomeFornecedor($nomeFornecedor);
        return $this;
    }

    public function withCidadeFornecedor(string $cidadeFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setCidadeFornecedor($cidadeFornecedor);
        return $this;
    }

    public function withLogradouroFornecedor(string $logradouroFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setLogradouroFornecedor($logradouroFornecedor);
        return $this;
    }

    public function withUfFornecedor(string $ufFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setUfFornecedor($ufFornecedor);
        return $this;
    }

    public function withBairroFornecedor(string $bairroFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setBairroFornecedor($bairroFornecedor);
        return $this;
    }

    public function withNumeroEnderecoFornecedor(int $numeroEnderecoFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setNumeroEnderecoFornecedor($numeroEnderecoFornecedor);
        return $this;
    }

    public function withCepFornecedor(string $cepFornecedor): CompraDTOBuilder
    {
        $this->compra_dto->setCepFornecedor($cepFornecedor);
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
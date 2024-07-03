<?php

namespace App\Http\Dto;

class FornecedorDTOBuilder {

    private FornecedorDTO $fornecedor_dto;

    public function __construct() 
    {
        $this->fornecedor_dto = new FornecedorDTO;
    }

    public function withCnpjFornecedor(string $cnpjFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setCnpjFornecedor($cnpjFornecedor);
        return $this;
    }

    public function withTelefoneFornecedor(string $telefoneFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setTelefoneFornecedor($telefoneFornecedor);
        return $this;
    }

    public function withNomeFornecedor(string $nomeFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setNomeFornecedor($nomeFornecedor);
        return $this;
    }

    public function withCidadeFornecedor(string $cidadeFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setCidadeFornecedor($cidadeFornecedor);
        return $this;
    }

    public function withLogradouroFornecedor(string $logradouroFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setLogradouroFornecedor($logradouroFornecedor);
        return $this;
    }

    public function withUfFornecedor(string $ufFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setUfFornecedor($ufFornecedor);
        return $this;
    }

    public function withBairroFornecedor(string $bairroFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setBairroFornecedor($bairroFornecedor);
        return $this;
    }

    public function withNumeroEnderecoFornecedor(int $numeroEnderecoFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setNumeroEnderecoFornecedor($numeroEnderecoFornecedor);
        return $this;
    }

    public function withCepFornecedor(string $cepFornecedor): FornecedorDTOBuilder
    {
        $this->fornecedor_dto->setCepFornecedor($cepFornecedor);
        return $this;
    }

    public function build(): FornecedorDTO
    {
        return $this->fornecedor_dto;
    }

}
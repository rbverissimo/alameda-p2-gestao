<?php

namespace App\Http\Dto;

class ImovelDTOBuilder {

    private ImovelDTO $imovel_dto;

    public function __construct() {
        $this->imovel_dto = new ImovelDTO();
        $this->imovel_dto->setEndereco(new EnderecoDTO);
    }

    public function withCep(string $cep): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setCep($cep);
        return $this;
    }

    public function withLogradouro(?string $logradouro): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setLogradouro($logradouro);
        return $this;
    }

    public function withBairro(string $bairro): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setBairro($bairro);
        return $this;
    }

    public function withNumero(?int $numero): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setNumero($numero);
        return $this;
    }

    public function withQuadra(?int $quadra): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setQuadra($quadra);
        return $this;
    }

    public function withLote(?int $lote): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setLote($lote);
        return $this;
    }

    public function withComplemento(string $complemento = null): ImovelDTOBuilder 
    {
        $this->imovel_dto->getEndereco()->setComplemento($complemento);
        return $this;
    }

    public function withNomeFantasia(string $nomefantasia): ImovelDTOBuilder 
    {
        $this->imovel_dto->setNomeFantasia($nomefantasia);
        return $this;
    }

    public function withCnpj(?string $cnpj): ImovelDTOBuilder
    {
        $this->imovel_dto->setCnpj($cnpj);
        return $this;
    }

    public function withCidade(string $cidade): ImovelDTOBuilder {
        $this->imovel_dto->getEndereco()->setCidade($cidade);
        return $this;
    }

    public function withUf(string $uf): ImovelDTOBuilder {
        $this->imovel_dto->getEndereco()->setUf($uf);
        return $this;
    }

    public function withImobiliaria(?int $imobiliaria): ImovelDTOBuilder
    {
        $this->imovel_dto->setImobiliaria($imobiliaria);
        return $this;
    }

    public function build(): ImovelDTO {
        return $this->imovel_dto;
    }
}
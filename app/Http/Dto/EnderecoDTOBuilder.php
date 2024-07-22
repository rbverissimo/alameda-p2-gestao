<?php 

namespace App\Http\Dto;

class EnderecoDTOBuilder {

    private EnderecoDTO $enderecoDTO;

    public function __construct() {
        $this->enderecoDTO = new EnderecoDTO();
    }

    public function withCep($cep): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setCep($cep);
        return $this;
    }

    public function withNumero($numero): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setNumero($numero);
        return $this;
    }

    public function withBairro($bairro): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setBairro($bairro);
        return $this;
    }

    public function withCidade($cidade): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setCidade($cidade);
        return $this;
    }


    public function withLogradouro($logradouro): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setLogradouro($logradouro);
        return $this;
    }


    public function withUf($uf): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setUf($uf);
        return $this;
    }


    public function withQuadra($quadra): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setQuadra($quadra);
        return $this;
    }


    public function withLote($lote): EnderecoDTOBuilder
    {
        $this->enderecoDTO->setLote($lote);
        return $this;
    }


    public function build(): EnderecoDTO {
        return $this->enderecoDTO;
    }
}
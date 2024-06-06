<?php

namespace App\Http\Dto;

class ImovelDTOBuilder {

    private ImovelDTO $imovel_dto;

    public function withCep(string $cep): ImovelDTOBuilder {
        $this->imovel_dto->setCep($cep);
        return $this;
    }

    public function withLogradouro(string $logradouro): ImovelDTOBuilder {
        $this->imovel_dto->setLogradouro($logradouro);
        return $this;
    }

    public function withBairro(string $bairro): ImovelDTOBuilder {
        $this->imovel_dto->setBairro($bairro);
        return $this;
    }

    public function withNumero(int $numero): ImovelDTOBuilder {
        $this->imovel_dto->setNumero($numero);
        return $this;
    }

    public function withQuadra(int $quadra): ImovelDTOBuilder {
        $this->imovel_dto->setQuadra($quadra);
        return $this;
    }

    public function withLote(int $lote): ImovelDTOBuilder {
        $this->imovel_dto->setLote($lote);
        return $this;
    }

    public function withComplemento(string $complemento): ImovelDTOBuilder {
        $this->imovel_dto->setComplemento($complemento);
        return $this;
    }

    public function withNomeFantasia(string $nomefantasia): ImovelDTOBuilder {
        $this->imovel_dto->setNomeFantasia($nomefantasia);
        return $this;
    }

    public function withUsuario(int $usuario): ImovelDTOBuilder{
        $this->imovel_dto->setUsuario($usuario);
        return $this;
    }

    public function build(): ImovelDTO {
        return $this->imovel_dto;
    }
}
<?php

namespace App\Http\Dto;

class ImovelDTOBuilder {

    private string $cep;
    private string $logradouro;
    private string $bairro;
    private int $numero;
    private int $quadra;
    private int $lote;
    private string $complemento;
    private string $nomefantasia; 

    public function withCep(string $cep): ImovelDTOBuilder {
        $this->cep = $cep;
        return $this;
    }

    public function withLogradouro(string $logradouro): ImovelDTOBuilder {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function withBairro(string $bairro): ImovelDTOBuilder {
        $this->bairro = $bairro;
        return $this;
    }

    public function withNumero(int $numero): ImovelDTOBuilder {
        $this->numero = $numero;
        return $this;
    }

    public function withQuadra(int $quadra): ImovelDTOBuilder {
        $this->quadra = $quadra;
        return $this;
    }

    public function withLote(int $lote): ImovelDTOBuilder {
        $this->lote = $lote;
        return $this;
    }

    public function withComplemento(string $complemento): ImovelDTOBuilder {
        $this->complemento = $complemento;
        return $this;
    }

    public function withNomeFantasia(string $nomefantasia): ImovelDTOBuilder {
        $this->nomefantasia = $nomefantasia;
        return $this;
    }

    public function build(): ImovelDTO {
        return new ImovelDTO($this->cep,
        $this->logradouro,
        $this->bairro,
        $this->numero,
        $this->quadra,
        $this->lote,
        $this->complemento,
        $this->nomefantasia);
    }
}
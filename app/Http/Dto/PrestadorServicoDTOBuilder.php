<?php

namespace App\Http\Dto;

class PrestadorServicoDTOBuilder {

    private PrestadorServicoDTO $prestador_servico_dto;

    public function __construct() {
        $this->prestador_servico_dto = new PrestadorServicoDTO();
    }

    public function withPessoa(PessoaDTO $pessoa){
        $this->prestador_servico_dto->setPessoaDto($pessoa);
    }

    public function withImobiliaria(int $imobiliaria)
    {
        $this->prestador_servico_dto->setImobiliaria($imobiliaria);
    }

    public function withTipos(array $tipos){
        $this->prestador_servico_dto->setTipos($tipos);
    }

    public function build(): PrestadorServicoDTO
    {
        return $this->prestador_servico_dto;
    }
}
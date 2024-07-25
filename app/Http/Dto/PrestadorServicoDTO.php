<?php

namespace App\Http\Dto;

class PrestadorServicoDTO {


    private PessoaDTO $pessoa_dto;
    private array $tipos;
    private int $imobiliaria;

    public function getPessoaDto(): PessoaDTO
    {
        return $this->pessoa_dto;
    }

    public function getTipos(): array
    {
        return $this->tipos;
    }

    public function getImobiliaria(): int
    {
        return $this->imobiliaria;
    }

    public function setPessoaDto(PessoaDTO $pessoaDto): void
    {
        $this->pessoa_dto = $pessoaDto;
    }

    public function setTipos(array $tipos): void
    {
        $this->tipos = $tipos;
    }

    public function setImobiliaria(int $imobiliaria): void
    {
        $this->imobiliaria = $imobiliaria;
    }


}
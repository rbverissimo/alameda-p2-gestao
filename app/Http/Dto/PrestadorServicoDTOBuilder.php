<?php

namespace App\Http\Dto;


class PrestadorServicoDTOBuilder {

    private PrestadorServicoDTO $prestador_servico_dto;

    public function __construct() {
        $this->prestador_servico_dto = new PrestadorServicoDTO();
    }

    public function withNome(string $nome): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setNome($nome);
        return $this;
    }

    public function withCpf(?string $cpf): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setCpf($cpf);
        return $this;
    }

    public function withCnpj(?string $cnpj): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setCnpj($cnpj);
        return $this;
    }

    public function withTelefone(TelefoneDTO $telefone): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setTelefone($telefone);
        return $this;
    }

    public function withEndereco(?EnderecoDTO $endereco): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setEndereco($endereco);
        return $this;
    }

    public function withImobiliaria(int $imobiliaria): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setImobiliaria($imobiliaria);
        return $this;
    }

    public function withTipos(array $tipos): PrestadorServicoDTOBuilder
    {
        $this->prestador_servico_dto->setTipos($tipos);
        return $this;
    }

    public function build(): PrestadorServicoDTO
    {
        return $this->prestador_servico_dto;
    }
}
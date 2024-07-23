<?php

namespace App\Http\Dto;

class PessoaDTOBuilder {


    private PessoaDTO $pessoa_dto;

    public function __construct() {
        $this->pessoa_dto = new PessoaDTO();
    }

    public function withCpf(?string $cpf): PessoaDTOBuilder
    {
        $this->pessoa_dto->setCpf($cpf);
        return $this;
    }

    public function withCnpj(?string $cnpj): PessoaDTOBuilder
    {
        $this->pessoa_dto->setCnpj($cnpj);
        return $this;
    }

    public function withNome(string $nome): PessoaDTOBuilder
    {
        $this->pessoa_dto->setNome($nome);
        return $this;
    }

    public function withTelefoneCelular(string $telefoneCelular): PessoaDTOBuilder
    {
        $this->pessoa_dto->setTelefoneCelular($telefoneCelular);
        return $this;
    }

    public function withTelefoneFixo(string $telefoneFixo): PessoaDTOBuilder
    {
        $this->pessoa_dto->setTelefoneFixo($telefoneFixo);
        return $this;
    }
    
    public function withTelfoneTrabalho(string $telefoneTrabalho): PessoaDTOBuilder
    {
        $this->pessoa_dto->setTelefoneTrabalho($telefoneTrabalho);
        return $this;
    }

    public function withEndereco(?EnderecoDTO $endereco): PessoaDTOBuilder
    {
        $this->pessoa_dto->setEndereco($endereco);
        return $this;
    }

    public function build(): PessoaDTO
    {
        return $this->pessoa_dto;
    }

}
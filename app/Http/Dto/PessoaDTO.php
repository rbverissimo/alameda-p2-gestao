<?php

namespace App\Http\Dto;

class PessoaDTO {

    private ?string $cnpj;
    private ?string $cpf;
    private string $nome;
    private ?string $telefone_celular;
    private ?string $telefone_fixo;
    private ?string $telefone_trabalho; 
    private ?EnderecoDTO $endereco; 

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }
  
    public function getNome(): string
    {
        return $this->nome;
    }
  
    public function getTelefoneCelular(): string
    {
        return $this->telefone_celular;
    }
  
    public function getTelefoneFixo(): string
    {
        return $this->telefone_fixo;
    }
  
    public function getTelefoneTrabalho(): string
    {
        return $this->telefone_trabalho;
    }
  
    public function getEndereco(): EnderecoDTO
    {
        return $this->endereco;
    }

    public function setCnpj(?string $cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function setCpf(?string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setTelefoneCelular(string $telefone_celular)
    {
        $this->telefone_celular = $telefone_celular;
    }

    public function setTelefoneFixo(string $telefone_fixo)
    {
        $this->telefone_fixo = $telefone_fixo;
    }

    public function setTelefoneTrabalho(string $telefone_trabalho)
    {
        $this->telefone_trabalho = $telefone_trabalho;
    }

    public function setEndereco(?EnderecoDTO $endereco)
    {
        $this->endereco = $endereco;
    }

}
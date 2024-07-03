<?php

namespace App\Http\Dto;

class FornecedorDTO {

    private string $cnpj_fornecedor;
    private string $telefone_fornecedor;
    private string $nome_fornecedor;
    private string $cidade_fornecedor;
    private string $logradouro_fornecedor;
    private string $uf_fornecedor;
    private string $bairro_fornecedor;
    private int $numero_endereco_fornecedor;
    private string $cep_fornecedor;


    //Getters
    public function getCnpjFornecedor(): string
    {
        return $this->cnpj_fornecedor;
    }
  
    public function getTelefoneFornecedor(): string
    {
        return $this->telefone_fornecedor;
    }
  
    public function getNomeFornecedor(): string
    {
        return $this->nome_fornecedor;
    }
  
    public function getCidadeFornecedor(): string
    {
        return $this->cidade_fornecedor;
    }
  
    public function getLogradouroFornecedor(): string
    {
        return $this->logradouro_fornecedor;
    }
  
    public function getUfFornecedor(): string
    {
        return $this->uf_fornecedor;
    }
  
    public function getBairroFornecedor(): string
    {
        return $this->bairro_fornecedor;
    }
  
    public function getNumeroEnderecoFornecedor(): int
    {
        return $this->numero_endereco_fornecedor;
    }
  
    public function getCepFornecedor(): string
    {
        return $this->cep_fornecedor;
    }

    //Setters
    public function setCnpjFornecedor(string $cnpj_fornecedor): void
    {
        $this->cnpj_fornecedor = $cnpj_fornecedor;
    }

    public function setTelefoneFornecedor(string $telefone_fornecedor): void
    {
        $this->telefone_fornecedor = $telefone_fornecedor;
    }

    public function setNomeFornecedor(string $nome_fornecedor): void
    {
        $this->nome_fornecedor = $nome_fornecedor;
    }

    public function setCidadeFornecedor(string $cidade_fornecedor): void
    {
        $this->cidade_fornecedor = $cidade_fornecedor;
    }

    public function setLogradouroFornecedor(string $logradouro_fornecedor): void
    {
        $this->logradouro_fornecedor = $logradouro_fornecedor;
    }

    public function setUfFornecedor(string $uf_fornecedor): void
    {
        $this->uf_fornecedor = $uf_fornecedor;
    }

    public function setBairroFornecedor(string $bairro_fornecedor): void
    {
          $this->bairro_fornecedor = $bairro_fornecedor;
    }

    public function setNumeroEnderecoFornecedor(int $numero_endereco_fornecedor): void
    {
        $this->numero_endereco_fornecedor = $numero_endereco_fornecedor;
    }

    public function setCepFornecedor(string $cep_fornecedor): void
    {
        $this->cep_fornecedor = $cep_fornecedor;
    }

}
<?php

namespace App\Http\Dto;

class CompraDTO {

    private string $cnpj_fornecedor;
    private string $telefone_fornecedor;
    private string $nome_fornecedor;
    private string $cidade_fornecedor;
    private string $logradouro_fornecedor;
    private string $uf_fornecedor;
    private string $bairro_fornecedor;
    private int $numero_endereco_fornecedor;
    private string $cep_fornecedor;
    private int $imovel_compra;
    private int $tipo_compra;
    private string $data_compra;
    private float $valor_compra;
    private string $descricao;
    private string $nota;
    private string $nrDocumento_nota;
    private string $garantia;
    private int $qtde_dias_garantia;
    private string $nome_vendedor;
    private int $forma_pagamento;
    private int $qtde_parcelas;

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
  
    public function getImovelCompra(): int
    {
        return $this->imovel_compra;
    }
  
    public function getTipoCompra(): int
    {
        return $this->tipo_compra;
    }
  
    public function getDataCompra(): string
    {
        return $this->data_compra;
    }
  
    public function getValorCompra(): float
    {
        return $this->valor_compra;
    }
  
    public function getDescricao(): string
    {
        return $this->descricao;
    }
  
    public function getNota(): string
    {
        return $this->nota;
    }
  
    public function getNrDocumentoNota(): string
    {
        return $this->nrDocumento_nota;
    }
  
    public function getGarantia(): string
    {
        return $this->garantia;
    }
  
    public function getQtdeDiasGarantia(): int
    {
        return $this->qtde_dias_garantia;
    }
  
    public function getNomeVendedor(): string
    {
        return $this->nome_vendedor;
    }
  
    public function getFormaPagamento(): int
    {
        return $this->forma_pagamento;
    }
  
    public function getQtdeParcelas(): int
    {
        return $this->qtde_parcelas;
    }
  
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

  public function setImovelCompra(int $imovel_compra): void
  {
      $this->imovel_compra = $imovel_compra;
  }

  public function setTipoCompra(int $tipo_compra): void
  {
      $this->tipo_compra = $tipo_compra;
  }

  public function setDataCompra(string $data_compra): void
  {
      $this->data_compra = $data_compra;
  }

  public function setValorCompra(float $valor_compra): void
  {
      $this->valor_compra = $valor_compra;
  }

  public function setDescricao(string $descricao): void
  {
      $this->descricao = $descricao;
  }

  public function setNota(string $nota): void
  {
      $this->nota = $nota;
  }

  public function setNrDocumentoNota(string $nrDocumento_nota): void
  {
      $this->nrDocumento_nota = $nrDocumento_nota;
  }

  public function setGarantia(string $garantia): void
  {
      $this->garantia = $garantia;
  }

  public function setQtdeDiasGarantia(int $qtde_dias_garantia): void
  {
      $this->qtde_dias_garantia = $qtde_dias_garantia;
  }

}
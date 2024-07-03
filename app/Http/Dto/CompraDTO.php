<?php

namespace App\Http\Dto;

class CompraDTO {

    private int $id_fornecedor;
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
    public function getIdFornecedor(): int {
        return $this->id_fornecedor;
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

  
    public function setIdFornecedor(int $id_fornecedor): void
    {
        $this->id_fornecedor = $id_fornecedor;
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

    public function setNomeVendedor(string $nome_vendedor): void
    {
        $this->nome_vendedor = $nome_vendedor;
    }

    public function setFormaPagamento(int $forma_pagamento): void
    {
        $this->forma_pagamento = $forma_pagamento;
    }

    public function setQtdeDiasGarantia(int $qtde_dias_garantia): void
    {
        $this->qtde_dias_garantia = $qtde_dias_garantia;
    }

    public function setQtdeParcelas(int $qtde_parcelas): void
    {
        $this->qtde_parcelas = $qtde_parcelas;
    }

}
<?php

namespace App\ValueObjects;

class EnderecoVO {

      private string $cep;
      private string $logradouro;
      private string $bairro;
      private int $numero;
      private string $cidade;
      private string $uf;
      private ?int $quadra;
      private ?int $lote;

      public function __construct(string $cep, string $logradouro, string $bairro, int $numero, 
                                  string $cidade, string $uf, ?int $quadra = null, ?int $lote = null) {
            $this->cep = $cep;
            $this->logradouro = $logradouro;
            $this->bairro = $bairro;
            $this->numero = $numero;
            $this->cidade = $cidade;
            $this->uf = $uf;
            $this->quadra = $quadra;
            $this->lote = $lote;
      }

      public function getCep(): string 
      {
            return $this->cep;
      }     

      public function getLogradouro(): string 
      {
            return $this->logradouro;
      }

      public function getBairro(): string 
      {
            return $this->bairro;
      }

      public function getNumero(): int 
      {
            return $this->numero;
      }

      public function getCidade(): string 
      {
            return $this->cidade;
      }

      public function getUf(): string 
      {
            return $this->uf;
      }

      public function getQuadra(): ?int 
      {
            return $this->quadra;
      }

      public function getLote(): ?int 
      {
            return $this->lote;
      }

      public function setCep(string $cep): void 
      {
            $this->cep = $cep;
      }

      public function setLogradouro(string $logradouro): void 
      {
            $this->logradouro = $logradouro;
      }

      public function setBairro(string $bairro): void 
      {
            $this->bairro = $bairro;
      }

      public function setNumero(int $numero): void 
      {
            $this->numero = $numero;
      }

      public function setCidade(string $cidade): void 
      {
            $this->cidade = $cidade;
      }

      public function setUf(string $uf): void 
      {
            $this->uf = $uf;
      }

      public function setQuadra(?int $quadra): void 
      {
            $this->quadra = $quadra;
      }

      public function setLote(?int $lote): void 
      {
            $this->lote = $lote;
      }

      public function getJson(){
            return [
                  'cep' => $this->cep,
                  'logradouro' => $this->logradouro,
                  'numero' => $this->numero,
                  'bairro' => $this->bairro,
                  'cidade' => $this->cidade,
                  'uf' => $this->uf,
                  'quadra' => $this->quadra,
                  'lote' => $this->lote
            ];
      }

}
<?php

namespace App\ValueObjects;

/**
 * Essa classe não deve ser usada. Ela ainda existe apenas para manter partes do sistema
 * que ainda possam depender dela funcionando. Ela será removida em versões futuras. 
 * 
 * @deprecated
 */
class PessoaVO {

      private string $nome;
      private ?string $cnpj;
      private ?string $cpf;
      private ?EnderecoVO $endereco;

      public function __construct(string $nome, ?string $cnpj, ?string $cpf, ?EnderecoVO $endereco) {
            $this->nome = $nome;
            $this->cnpj = $cnpj;
            $this->cpf = $cpf;
            $this->endereco = $endereco;
      }

      public function getNome(): string 
      {
            return $this->nome;
      }

      public function getCnpj(): ?string 
      {
            return $this->cnpj;
      }

      public function getCpf(): ?string 
      {
            return $this->cpf;
      }

      public function getEndereco(): ?EnderecoVO 
      {
            return $this->endereco;
      }

      public function setNome(string $nome): void 
      {
            $this->nome = $nome;
      }

      public function setCnpj(?string $cnpj): void 
      {
            $this->cnpj = $cnpj;
      }

      public function setCpf(?string $cpf): void 
      {
            $this->cpf = $cpf;
      }

      public function setEndereco(?EnderecoVO $endereco): void 
      {
            $this->endereco = $endereco;
      }
}
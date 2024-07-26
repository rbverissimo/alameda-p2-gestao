<?php

namespace App\ValueObjects;

class PrestadorServicoVO {


      private PessoaVO $pessoa;
      private EnderecoVO $endereco;

      /**
       * 
       * @var array App\ValueObjects\TiposPrestadores
       */
      private array $tipos; 

      public function __construct(PessoaVO $pessoa, EnderecoVO $endereco, array $tipos) {
            $this->pessoa = $pessoa;
            $this->endereco = $endereco;
            $this->tipos = $tipos;
      }

      public function getPessoa(): PessoaVO
      {
            return $this->pessoa;
      }

      public function getEndereco(): EnderecoVO
      {
            return $this->endereco;
      }

      public function getTipos(): array
      {
            return $this->tipos;
      }

      public function setPessoa(PessoaVO $pessoa): void 
      {
            $this->pessoa = $pessoa;
      }

      public function setEndereco(EnderecoVO $endereco): void 
      {
            $this->endereco = $endereco;
      }

      public function setTipos(array $tipos): void 
      {
            $this->tipos = $tipos; 
      }


}
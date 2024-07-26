<?php

namespace App\ValueObjects;

class TiposPrestadoresVO {

      private int $id;
      private ?string $codigoSistema;
      private string $tipo;

      public function __construct(int $id, ?string $codigoSistema = null, string $tipo) {
            $this->id = $id;
            $this->codigoSistema = $codigoSistema;
            $this->tipo = $tipo;
      }
}
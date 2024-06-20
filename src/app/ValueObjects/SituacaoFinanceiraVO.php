<?php

namespace App\ValueObjects;

class SituacaoFinanceiraVO {
      public $referencia;
      public $aluguel;
      public $luz;
      public $agua;
      public $total;
      public $saldo;
      public $saldoReferencia;
      

      public function __construct($referencia, $aluguel, $luz, $agua, $total, $saldo, $saldoReferencia)
      {
            $this->referencia = $referencia;
            $this->aluguel = $aluguel;
            $this->luz = $luz;
            $this->agua = $agua;
            $this->total = $total;
            $this->saldo = $saldo;
            $this->saldoReferencia = $saldoReferencia;
      }
}
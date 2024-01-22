<?php

namespace App\ValueObjects;

class SituacaoFinanceiraVO {
      public $referencia;
      public $aluguel;
      public $luz;
      public $agua;
      public $total;
      public $quitado;
      public $saldo;
      

      public function __construct($referencia, $aluguel, $luz, $agua, $total, $quitado, $saldo)
      {
            $this->referencia = $referencia;
            $this->aluguel = $aluguel;
            $this->luz = $luz;
            $this->agua = $agua;
            $this->total = $total;
            $this->quitado = $quitado; 
            $this->saldo = $saldo;
      }
}
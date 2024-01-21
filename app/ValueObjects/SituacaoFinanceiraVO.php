<?php

class SituacaoFinanceiraVO {
      public $referencia;
      public $aluguel;
      public $luz;
      public $agua;
      public $total;
      public $quitado;
      public $debito;
      public $credito;

      public function __construct($referencia, $aluguel, $luz, $agua, $total, $quitado, $debito, $credito)
      {
            $this->referencia = $referencia;
            $this->aluguel = $aluguel;
            $this->luz = $luz;
            $this->agua = $agua;
            $this->total = $total;
            $this->quitado = $quitado; 
            $this->debito = $debito;
            $this->credito = $credito; 
      }
}
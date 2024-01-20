<?php 

class ContasUtils {
      private $contas;

      private function __construct($contas)
      {
            $this->contas = $contas;
      }

      public static function create($contas){
            return new self($contas);
      }

      public function maxId(){
            // implementar
      }

      public function filterByParam($paramName, $paramValue){
            $this->contas = array_filter($this->contas, function($conta) use ($paramName, $paramValue)
            {
                  return $conta->{$paramName} === $paramValue;
            });

            return $this; 
      }

      public function getContasByTipo($tipoconta){
            $this->contas = array_filter($this->contas, function($conta) use ($tipoconta){
                  return $conta->tipocodigo === $tipoconta;
            });

            return $this; 
      }

      public function getContasBySala($salacodigo){
            $this->contas = array_filter($this->contas, function($conta) use ($salacodigo){
                  return $conta->salacodigo === $salacodigo;
            });

            return $this; 
      }

      public function getContas(){
            return $this->contas;
      }
}
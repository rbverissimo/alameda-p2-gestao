<?php

namespace App\ValueObjects;


class SearchInputVO {

      private string $search = 'search';
      private $objToSerialize;

      public function __construct($objToSerialize) {
            $this->objToSerialize = $objToSerialize;
      }

      public function getJson(){
            return [ 
                  $this->search => $this->objToSerialize
            ];
      }

}
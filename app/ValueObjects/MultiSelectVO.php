<?php

namespace App\ValueObjects;

class MultiSelectVO {

    private mixed $dataInput; 
    private SelectVO $select;

    public function __construct(mixed $dataInput, SelectVO $select) {
        $this->dataInput = $dataInput;
        $this->select = $select;
    }

    public function getJson(){
        return [
            'dataInput' => $this->dataInput,
            'select' => $this->select->getJson()
        ];
    }

}
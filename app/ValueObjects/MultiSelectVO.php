<?php

namespace App\ValueObjects;

class MultiSelectVO {

    private string $dataInput; 
    private SelectVO $select;

    public function __construct(string $dataInput, SelectVO $select) {
        $this->dataInput = $dataInput;
        $this->select = $select;
    }

    public function getJson(){
        return [
            'dataInput' => $this->dataInput,
            'select' => $this->select->getJson()
        ];
    }

    public function getDataInput(): string 
    {
        return $this->dataInput;
    }
}
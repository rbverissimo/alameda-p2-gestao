<?php

namespace App\ValueObjects;

class SelectVO {

    private string $selectedValue;
    private array $options;

    public function __construct(string $selectedValue, array $options) {
        $this->selectedValue = $selectedValue;
        $this->options = $options;
    }

    public function getJson(){
        return [ 'selectedValue' => $this->selectedValue, 'options' => $this->options];
    }

}
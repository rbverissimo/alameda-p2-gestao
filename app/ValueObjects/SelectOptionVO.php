<?php

namespace App\ValueObjects;

class SelectOptionVO {

    private string $value;
    private string $view;

    public function __construct(string $value, string $view) {
        $this->value = $value;
        $this->view = $view;
    }

    public function getJson(){
        return [
            'value' => $this->value,
            'view' => $this->view
        ];
    }

    public static function getPrimeiroElementoVazio()
    {
        $select_vazio = new SelectOptionVO('0', '');
        return $select_vazio->getJson(); 
    }

}
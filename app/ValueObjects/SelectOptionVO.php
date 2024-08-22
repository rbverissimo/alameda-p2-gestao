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
        $select_vazio = new SelectOptionVO('', '');
        return $select_vazio->getJson(); 
    }

    /**
     * Esse método recebe uma mensagem que possa ser exibida como placeholder
     * no front-end da aplicação. O value é uma string vazia.
     * @param string 
     * @return SelectVO
     */
    public static function getPrimeiroElementoComMensagem(string $mensagem)
    {
        $select_mensagem = new SelectVO('', $mensagem);
        return $select_mensagem->getJson();
    }

}
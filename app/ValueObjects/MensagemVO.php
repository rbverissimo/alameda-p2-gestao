<?php

namespace App\ValueObjects;

class MensagemVO {

    private string $status;
    private string $mensagem;
    
    public function __construct(string $status, string $mensagem) {
        $this->status = $status;
        $this->mensagem = $mensagem;
    }

    public function getJson(){
        return [
            'status' => $this->status,
            'mensagem' => $this->mensagem
        ];
    }

}
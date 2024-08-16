<?php

namespace App\Models\BusinessObjects;

class ServicosTomadosBO {


    private array $REGRAS_VALIDACAO = [
        'ud_codigo' => 'unique:servicos',
        'ud_nome' => 'unique:servicos'
    ];

    
    
    public function getRegrasValidacao(){
        return $this->REGRAS_VALIDACAO;
    }
}
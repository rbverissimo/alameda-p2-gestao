<?php

namespace App\Models\BusinessObjects;

use App\Services\ServicosTomadosService;
use App\Services\UsuarioService;

class ServicosTomadosBO {


    private array $REGRAS_VALIDACAO = [
        'ud_codigo' => 'unique:servicos',
        'ud_nome' => 'unique:servicos'
    ];
    
    public function getRegrasValidacao(){
        return $this->REGRAS_VALIDACAO;
    }

    public function getPainelServicosLista(){
        $imobiliarias = UsuarioService::getImobiliarias();
        return ServicosTomadosService::getPainelListaServicos($imobiliarias);
    }

    public function getServicoBy($idServico){
        return ServicosTomadosService::getServicosBy($idServico);
    }
}
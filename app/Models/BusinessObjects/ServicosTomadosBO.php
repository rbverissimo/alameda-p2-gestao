<?php

namespace App\Models\BusinessObjects;

use App\Services\ServicosTomadosService;
use App\Services\UsuarioService;
use App\Utils\CollectionUtils;

class ServicosTomadosBO {


    private array $REGRAS_VALIDACAO = [
        'ud_codigo' => 'unique:servicos',
        'ud_nome' => 'unique:servicos'
    ];
    
    public function getRegrasValidacao(){
        return $this->REGRAS_VALIDACAO;
    }

    public function getDto($inputs, $idServico){
        $old_model = $this->getServicoBy($idServico);
        
        $prestadores_old = array_map(function($prestador){
            return $prestador['nome'];
        }, $old_model->getRelation('prestadores')->toArray());
        
        $prestadores_update = array_values(CollectionUtils::getAssociativeArray($inputs, '-', 2, 'prestador-servico'));
        
        dd($inputs, $prestadores_old, $prestadores_update);

    }

    public function getPainelServicosLista(){
        $imobiliarias = UsuarioService::getImobiliarias();
        return ServicosTomadosService::getPainelListaServicos($imobiliarias);
    }

    public function getServicoBy($idServico){
        return ServicosTomadosService::getServicosBy($idServico);
    }
}
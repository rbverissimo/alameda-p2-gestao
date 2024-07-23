<?php

namespace App\Services;

use App\Models\Imobiliaria;
use App\ValueObjects\SelectOptionVO;

class ImobiliariasService {



    /**
     * Esse método retorna todos as imobiliárias de um determinado 
     * usuário em formato de lista usando o SelectOptionVO
     * 
     */
    public static function getListaImobiliariasSelect(){
        $usuario = UsuarioService::getUsuarioLogado();
        $imobiliarias = Imobiliaria::where('usuario_id', $usuario)->get();
        $options = [];
        foreach ($imobiliarias as $imobiliaria) {
            $option = new SelectOptionVO($imobiliaria->id, $imobiliaria->nome);
            $options[] = $option->getJson();
        }
        return array_merge($options);
    }

}
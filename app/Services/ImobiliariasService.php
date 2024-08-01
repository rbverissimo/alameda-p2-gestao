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
        $options = [SelectOptionVO::getPrimeiroElementoVazio()];
        foreach ($imobiliarias as $imobiliaria) {
            $option = new SelectOptionVO($imobiliaria->id, $imobiliaria->nome);
            $options[] = $option->getJson();
        }

        return array_merge($options);
    }

    public static function getNomeImobiliaria($imobiliaria){
        $imobiliaria = Imobiliaria::select('nome')
            ->where('id', $imobiliaria)
            ->first();
        return $imobiliaria->nome;
    }

    public static function getImoveisBy($imobiliaria){
        $imobiliaria = Imobiliaria::with('imoveis')->where('id', $imobiliaria)->first();
        return  count($imobiliaria->getRelation('imoveis')) > 0 ? $imobiliaria->getRelation('imoveis') : [];
    }

}
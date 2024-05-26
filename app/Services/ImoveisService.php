<?php

namespace App\Services;

use App\Models\UsuarioImovel;

class ImoveisService {
    
    /**
     * Retorna dos imóveis ligados àquele usuário logado
     */
    public static function getImoveisByUsuarioLogado(){
        $usuarioLogado = UsuarioService::getUsuarioLogado();

        return UsuarioImovel::where('idUsuario', $usuarioLogado)->get();
    }

    public static function getImoveis(){
        $usuarioLogado = UsuarioService::getUsuarioLogado();
        $imoveis_usuario = UsuarioImovel::with('imoveis')->where('idUsuario', $usuarioLogado)->get();

        $imoveis = [];
        

        return $imoveis;
    }

}
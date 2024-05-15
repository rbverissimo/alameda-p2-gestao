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

}
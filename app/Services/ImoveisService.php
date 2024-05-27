<?php

namespace App\Services;

use App\Models\Imovel;
use App\Models\Sala;
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
        $imoveis_usuario = UsuarioImovel::with('imoveis')
            ->where('idUsuario', $usuarioLogado)
            ->orderBy('idImovel', 'desc')
            ->get();

        $imoveis = [];

        foreach ($imoveis_usuario as $imovel_usuario) {
            if ($imovel_usuario->has('imoveis')) {
              $imoveis[] = $imovel_usuario->imoveis;
            }
        }

        return $imoveis;
    }

    /**
     * Esse método retorna as salas cadastradas ao um imóvel específico
     * 
     * @return Illuminate\Database\Eloquent\Collection 
     */
    public static function getSalaBy($imovel){
        return Sala::where('imovelcodigo', $imovel)->get();
    }

    /**
     * Esse método busca os tipos de contas associados a um imóvel
     * no banco de dados. Se ele encontrar, ele retorna um array
     * com os tipos. Caso contrário, ele retorna um array vazio. 
     * 
     * @return array de App\Models\TipoConta
     */
    public static function getTipoContasBy($imovel){
        $imovel = Imovel::with('tipos_contas')->where('id', $imovel)->first();

        return $imovel->tipos_contas ?? [];
    }

}
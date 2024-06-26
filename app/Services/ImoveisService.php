<?php

namespace App\Services;

use App\Models\Imovel;
use App\Models\Sala;
use App\Models\TipoSala;
use App\Models\UsuarioImovel;

class ImoveisService {
    
    /**
     * Retorna dos imóveis ligados àquele usuário logado
     */
    public static function getImoveisByUsuarioLogado(){
        $user = UsuarioService::getUsuarioLogado();
        $usuario_imoveis = UsuarioImovel::select('idImovel')
        ->where('idUsuario', $user)
        ->groupBy('idImovel')
        ->get();
        return $usuario_imoveis->pluck('idImovel')->toArray();
    }

    /**
     * Esse método retorna o ID máximo da tabela de imóveis
     * 
     * @return int
     */
    public static function getIDMaximo(){
        return Imovel::max('id');
    }

    /**
     * Esse método busca o imóvel junto de seu endereço no banco
     * de dados de acordo com ID passado no parâmetro
     * @return App\Models\Imovel
     */
    public static function getImovelBy($idImovel){
        return Imovel::with('endereco')->find($idImovel);
    }


    /**
     * Esse método busca o imóvel junto de seu endereço e suas salas
     * relacionadas ao mesmo no banco de dados de acordo com o ID passado
     * no parâmetro da assinatura do método
     * 
     * @return App\Models\Imovel
     */
    public static function getImovelWithSalasBy($idImovel){
        return Imovel::with('endereco')->with('sala')->find($idImovel);
    }

    /**
     * Esse método retorna uma lista de imóveis de acordo
     * com o usuário logado no sistema
     * @return array 
     */
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

    /**
     * Esse método busca as informações de uma sala junto
     * ao imóvel ao qual está associada
     * 
     * @return App\Models\Sala
     */
    public static function getSalaImovelBy($sala){
        return Sala::with('inquilino')->where('id', $sala)->first();
    }

    /**
     * Esse método busca um registro de tipo de sala apenas com a descrição 
     * no objeto de retorno. 
     * 
     * @return App\Models\TipoSala
     */
    public static function getTipoSalaBy($idTipoSala){
        return TipoSala::where('id', $idTipoSala)->pluck('descricao')->first();
    }

}
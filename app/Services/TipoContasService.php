<?php

namespace App\Services;

use App\Models\TipoConta;

class TipoContasService {

    public static function getDescricaoTipoContaBy($id){
        return TipoConta::where('id', $id)->value('descricao');
    }

    public static function getCodigoTipoContaBy($id){
        return TipoConta::where('id', $id)->value('codigo');
    }

    /**
     * Esse método busca todos os tipos de contas que são 
     * padrão do sistema original. Aquelas que estão marcadas com 'S'
     * no tipo de conta. 
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getTiposContasDoSistema(){
        return TipoConta::where('sistema', 'S')->get();
    }

    public static function getTiposContasDoUsuario(int $usuario){

    }

    /**
     * Esse método busca no banco de dados pelo flag que indica
     * se uma conta deve ser dividida proporcionalmente ou não entre 
     * todos os inquilinos de uma determinada sala
     * @return bool true se o flag for 'S' no banco de dados
     */
    public static function isTipoContaFatorDivisor($idTipoConta): bool {
        return TipoConta::where('id', $idTipoConta)->pluck('isFatorDivisor')->first() === 'S';
    }
}
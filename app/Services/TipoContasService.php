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
}
<?php

namespace App\Services;

use App\Models\Pessoa;

class PessoasService {

    /**
     * Esse método busca pelo ID máximo da tabela de pessoas
     * 
     * @return int o id máximo da tabela
     */
    public static function getIDMaximo(){
        return Pessoa::max('id');
    }

    public static function getPessoaBy($id){
        return Pessoa::find($id)->first();
    }


}
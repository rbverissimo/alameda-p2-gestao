<?php

namespace App\Services;

use App\Models\Endereco;

class EnderecosService {


    /**
     * @return int o ID máximo da tabela de endereços
     */
    public static function getIDMaximo(){
        return Endereco::max('id');
    }

}

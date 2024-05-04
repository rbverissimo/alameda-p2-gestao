<?php

namespace App\Services;

use App\Models\Pessoa;

class PessoasService {

    public static function getPessoaBy($id){
        return Pessoa::find($id)->first();
    }
}
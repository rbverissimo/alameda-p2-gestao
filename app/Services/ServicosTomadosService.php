<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ServicosTomadosService {


    public static function existsBy($paramName, $paramValue){
        $sql = 'SELECT ID FROM SERVICOS WHERE '.$paramName.' LIKE ? ';
        $bindings = [$paramValue];
        $select = DB::select($sql, $bindings);
        return count($select) > 0;
    }
}
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

    public static function getPainelListaServicos($imobiliarias){

        $sql = 'SELECT S.ID, S.UD_NOME, S.VALOR FROM SERVICOS S 
            JOIN SALAS SA ON SA.ID = S.SALACODIGO 
            JOIN IMOVEIS IM ON IM.ID = SA.IMOVELCODIGO
            WHERE IM.IMOBILIARIA_ID IN (?)';  
        
        try {
            $painel_lista_servicos = DB::select($sql, $imobiliarias->toArray());
            return $painel_lista_servicos;
        } catch (\Throwable $th) {
            
            LogErrosService::salvarErrosPassandoParametrosManuais(
                '/servicos',
                $th->getMessage(),
                json_encode([
                    'imobiliarias' => $imobiliarias,
                    'sql' => $sql, 
                    'bindings' => $imobiliarias->toArray(),
                ]),
                'GET'
            );

            throw $th;
        }
    }
}
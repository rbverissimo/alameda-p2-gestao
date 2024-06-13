<?php

namespace App\Utils;

use App\Http\Dto\SalaDTOBuilder;

abstract class SalasUtils {

    public static function mergeFormInputs($nome_salas, $tipo_salas){
        $salas_list = [];
        $salas_mapeadas = [];

        foreach ($nome_salas as $nome) {
            [$sala, $identificador] = explode('-', $nome);
            $salas_mapeadas[$identificador] = $sala;
        }

        foreach ($tipo_salas as $tipo) {
            [$tipoSala, $identificador] = explode('-', $tipo);
            if(isset($salas_mapeadas[$identificador])){
                $salas_list = (new SalaDTOBuilder)->withNomeSala($salas_mapeadas[$identificador])->withTipoSala($tipo)->build();
            }
        }

        return $salas_list;
    }
}
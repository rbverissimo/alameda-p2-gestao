<?php

namespace App\Utils;

use App\Http\Dto\SalaDTOBuilder;

abstract class SalasUtils {

    public static function mergeFormInputs(string $nome_salas_pattern, string $tipo_salas_pattern, array $nome_salas, array $tipo_salas): array {
        $salas_list = [];
        $salas_mapeadas = [];

        $nomeSalasPattern = "^{$nome_salas_pattern}-(\d+)$";
        $tipoSalasPattern = "^{$tipo_salas_pattern}-(\d+)$";

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
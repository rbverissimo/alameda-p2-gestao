<?php

namespace App\Utils;

use App\Http\Dto\SalaDTOBuilder;

abstract class SalasUtils {

    public static function getSalasDTOsFromMerge(array $nomeSalas, array $tipoSalas): array
    {
        $salasList = [];
        
        $nomeSalasPattern = "/^input-sala-form-nome-(\d+)$/";
        $tipoSalasPattern = "/^input-sala-form-tipo-(\d+)$/";

        foreach ($nomeSalas as $key => $nome) {
            if (preg_match($nomeSalasPattern, $key, $matches) !== 1) {
                continue;
            }
            $identificador = (int) $matches[1];

            $salasList[$identificador] = [
                'nome_sala' => $nome, 
                'tipo_sala' => null, 
            ];
        }


        foreach ($tipoSalas as $key => $tipo) {
            if (preg_match($tipoSalasPattern, $key, $matches) !== 1) {
                continue;
            }
            $identificador = (int) $matches[1];

            if (isset($salasList[$identificador])) {
                $salasList[$identificador]['tipo_sala'] = $tipo;
            }
        }

        dd($salasList);

        $salaDTOs = [];
        foreach ($salasList as $identificador => $salaData) {
            $salaDTOs[] = (new SalaDTOBuilder)
                ->withNomeSala($salaData['nome_sala'])
                ->withTipoSala($salaData['tipo_sala'])
                ->build();
        }

        return $salaDTOs;
    }
}
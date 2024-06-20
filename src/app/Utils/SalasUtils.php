<?php

namespace App\Utils;

use App\Http\Dto\SalaDTOBuilder;

abstract class SalasUtils {

    public static function getSalasDTOsFromMerge(array $nomeSalas, array $tipoSalas, int $idImovel): array
    {
        $salasList = [];
        
        foreach ($nomeSalas as $identificador => $nome) {
            $salasList[$identificador] = [
                'nome_sala' => $nome, 
                'tipo_sala' => null, 
            ];
        }

        foreach ($tipoSalas as $identificador => $tipo) {
            if (isset($salasList[$identificador])) {
                $salasList[$identificador]['tipo_sala'] = $tipo;
            }
        }

        $salaDTOs = [];
        foreach ($salasList as $identificador => $salaData) {
            $salaDTOs[] = (new SalaDTOBuilder)
                ->withNomeSala($salaData['nome_sala'])
                ->withTipoSala($salaData['tipo_sala'])
                ->withIdImovel($idImovel)
                ->build();
        }

        return $salaDTOs;
    }
}
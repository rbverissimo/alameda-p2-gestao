<?php

namespace App\Utils;

use App\Services\InquilinosService;

class InquilinosUtils {


    public static function getSomaDeTodosAlugueisBy($inquilino, $alugueis = null): float
    {
        $_alugueis = $alugueis;

        if($alugueis === null){
            $_alugueis = InquilinosService::getAluguelTodos($inquilino);
        }

        $max_id_aluguel = $alugueis[0]->id;
        $inicio_validade_aluguel_posterior = 0;

        $total = 0.0;

        foreach ($_alugueis as $aluguel) {
            $inicoValidade = $aluguel->inicioValidade;
            $inicio_validade_aluguel_posterior = $inicoValidade;
            $fimValidade = $aluguel->fimValidade ?? null;

            if($fimValidade === null){
                if($max_id_aluguel === $aluguel->id){
                    $fimValidade = ProjectUtils::getReferenciaSistema();
                } else {
                    $fimValidade = $inicio_validade_aluguel_posterior;
                }
            }

            $qtde_meses = ProjectUtils::getDiferencaDeMesesEntreReferencias($inicoValidade, $fimValidade);

            $total = $total + ($qtde_meses * $aluguel->valorAluguel);
        }

        return $total;

    }   

}
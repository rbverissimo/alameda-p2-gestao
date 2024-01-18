<?php

use App\Models\InquilinoConta;

class SituacaoFinanceiraService {

      public function buscarSituacaoFinanceira($inquilino_id){

            $conta_luz = InquilinoConta::select('valorinquilino')
            ->join('contas_imoveis', 'inquilinos_contas.contacodigo', '=', 'contas_imoveis.id')
            ->where('contas_imoveis.tipocodigo', 2)
            ->where('inquilinos_contas.inquilinocodigo', 1)
            ->orderByDesc('inquilinos_contas.id')
            ->first();

      }

}
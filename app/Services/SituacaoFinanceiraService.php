<?php

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;

class SituacaoFinanceiraService {

      public function buscarSituacaoFinanceira($inquilino_id, $referencia){

            // inquilino
            // referencia
            //quebrar a referência em ano e mês


            // descobrir a sala do inquilino 
            $sala_inquilino = Inquilino::select('salacodigo')->where('id', $inquilino_id);

            //Buscar uma collection de contas
            $contas = ContaImovel::where('salacodigo', $sala_inquilino)
                  ->where('ano', 2023)->where('mes', 12)
                  ->orderByDesc('id')
                  ->get();

            // buscar todas as contas do imóvel do mês com id máximo para aquela referência
            

            // buscar as contas do inquilino ligadas aquelas contas do imóvel

            // montar um objeto e retorna-lo; 

            $conta_luz = InquilinoConta::select('valorinquilino')
            ->join('contas_imoveis', 'inquilinos_contas.contacodigo', '=', 'contas_imoveis.id')
            ->where('contas_imoveis.tipocodigo', 2)
            ->where('inquilinos_contas.inquilinocodigo', $inquilino_id)
            ->orderByDesc('inquilinos_contas.id')
            ->first();

            $situacao_financeira = "";

            return $situacao_financeira;

      }

}
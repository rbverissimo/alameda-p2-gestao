<?php

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;

class SituacaoFinanceiraService {

      public function buscarSituacaoFinanceira($inquilino_id, $referencia){

            // inquilino
            // referencia
            $ano = ProjectUtils::getAnoFromReferencia($referencia);
            $mes = ProjectUtils::getMesFromReferencia($referencia);


            // descobrir a sala do inquilino 
            $sala_inquilino = Inquilino::select('salacodigo')->where('id', $inquilino_id);

            //Buscar uma collection de contas daquele ano-mês
            $contas = ContaImovel::where('ano', $ano)->where('mes', $mes)
                  ->orderByDesc('id')
                  ->get();
            
            $contas_agua = ProjectUtils::getContasByTipo($contas, 1);
            
            $contas_luz = ContasUtils::create($contas)
                  ->filterByParam('tipocodigo', 2)
                  ->filterByParam('salacodigo', $sala_inquilino)
                  ->getContas();

            $max_id_agua = ProjectUtils::getMaxID($contas_agua);
            $max_id_luz = ProjectUtils::getMaxID($contas_luz);

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
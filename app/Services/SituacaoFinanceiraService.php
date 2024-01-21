<?php

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;

class SituacaoFinanceiraService {

      public function buscarSituacaoFinanceira($inquilino_id, $referencia){

            $ano = ProjectUtils::getAnoFromReferencia($referencia);
            $mes = ProjectUtils::getMesFromReferencia($referencia);

            $conta_luz = $this->getValorInquilinoBy(2, $inquilino_id, $ano, $mes);
            $conta_agua = $this->getValorInquilinoBy(1, $inquilino_id, $ano, $mes);

            $situacao_financeira = "";

            return $situacao_financeira;

      }

      private function getValorInquilinoBy($tipoconta, $inquilino_id, $ano, $mes){

            return InquilinoConta::select('inquilinos_contas.valorinquilino')
                  ->join('contas_imoveis', 'inquilinos_contas.contacodigo', '=', 'contas_imoveis.id')
                  ->where('contas_imoveis.tipocodigo', $tipoconta)
                  ->where('inquilinos_contas.inquilinocodigo', $inquilino_id)
                  ->where('contas_imoveis.ano', $ano)
                  ->where('contas_imoveis.mes', $mes)
                  ->orderByDesc('contas_imoveis.id')
                  ->first();
      }

}
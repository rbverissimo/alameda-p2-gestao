<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\InquilinoConta;
use App\Models\InquilinoSaldo;
use App\Utils\ProjectUtils;
use App\ValueObjects\SituacaoFinanceiraVO;
use Illuminate\Support\Facades\DB;

class SituacaoFinanceiraService {

      public function __construct()
      {
            
      }

      public function buscarSituacaoFinanceira($inquilino_id, $referencia){

            $ano = ProjectUtils::getAnoFromReferencia($referencia);
            $mes = ProjectUtils::getMesFromReferencia($referencia);


            $aluguel = $this->getAluguelInquilino($inquilino_id);

            $conta_luz = $this->getValorInquilinoBy(2, $inquilino_id, $ano, $mes) != null ? 
                  $this->getValorInquilinoBy(2, $inquilino_id, $ano, $mes)->valorinquilino  : 0.0;

            $conta_agua = $this->getValorInquilinoBy(1, $inquilino_id, $ano, $mes) != null ?
                  $this->getValorInquilinoBy(1, $inquilino_id, $ano, $mes)->valorinquilino : 0.0;

            $total = $this->somarContas($aluguel->valorAluguel, $conta_luz, $conta_agua);

            $saldo = $this->getSaldo($total, $inquilino_id, $referencia);

            $situacao_financeira = new SituacaoFinanceiraVO(
            ProjectUtils::adicionarMascaraReferencia($referencia), 
            $aluguel->valorAluguel, 
            ProjectUtils::arrendondarParaDuasCasasDecimais($conta_luz), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($conta_agua), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($total), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($saldo));

            return $situacao_financeira;

      }

      private function getValorInquilinoBy($tipoconta, $inquilino_id, $ano, $mes){

            return DB::table('inquilinos_contas')->select('inquilinos_contas.valorinquilino')
                  ->join('contas_imoveis', 'inquilinos_contas.contacodigo', '=', 'contas_imoveis.id')
                  ->where('contas_imoveis.tipocodigo', $tipoconta)
                  ->where('inquilinos_contas.inquilinocodigo', $inquilino_id)
                  ->where('contas_imoveis.ano', $ano)
                  ->where('contas_imoveis.mes', $mes)
                  ->orderByDesc('contas_imoveis.id')
                  ->first();
      }

      private function getAluguelInquilino($inquilino_id) {
            return Inquilino::select('valorAluguel')->where('id', $inquilino_id)->first();
      }

      private function somarContas($aluguel, $conta_luz, $conta_agua){
            return $aluguel + $conta_luz + $conta_agua;
      }

      private function getSomaComprovantesReferencia($inquilino_id, $referencia){
            return Comprovante::select('valor')
            ->where('inquilino', $inquilino_id)
            ->where('referencia', $referencia)
            ->sum('valor');
      }
      
      private function getSaldo($total, $inquilino_id, $referencia){
            $inquilino_saldo = InquilinoSaldo::orderByDesc('id')->first();
            $valores_mes = $this->getSomaComprovantesReferencia($inquilino_id, $referencia);

            $saldo_mes = $valores_mes - $total; 

            if($inquilino_saldo == null) $inquilino_saldo = 0.0;

            return $inquilino_saldo + $saldo_mes;
      }

}
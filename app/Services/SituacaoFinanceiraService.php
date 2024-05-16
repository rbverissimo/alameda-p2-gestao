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

      /**
       * Busca o valor de uma conta de acordo seu tipo, inquilino, ano e mês
       * 
       */
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

      /**
       * Retorna a soma do aluguel com todas as contas do ano e mês para um determinado inquilino
       */
      private function getValoresSomadosMes($inquilino_id, $ano, $mes){

            $aluguel = $this->getAluguelInquilino($inquilino_id);
            $soma_contas = InquilinoConta::select('inquilinos_contas.valorinquilino')
                  ->join('contas_imoveis', 'contas_imoveis.id', 'inquilinos_contas.contacodigo')
                  ->where('inquilinos_contas.inquilinocodigo', $inquilino_id)
                  ->where('contas_imoveis.ano', $ano)
                  ->where('contas_imoveis.mes', $mes)
                  ->sum('inqulinos_contas.valorinquilino');

            return $aluguel + $soma_contas;

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
      
      /**
       * @param total recebe o total das contas para a referência
       * @param inquilino_id recebe o id do inquilino, necessário para buscar os valores do mês_referência
       * 
       */
      private function getSaldo($total, $inquilino_id, $referencia){
            $inquilino_saldo = InquilinoSaldo::orderByDesc('id')->first();
            $valores_mes = $this->getSomaComprovantesReferencia($inquilino_id, $referencia);

            $saldo_mes = $valores_mes - $total; 

            if($inquilino_saldo == null) $inquilino_saldo = 0.0;

            return $inquilino_saldo + $saldo_mes;
      }

      /**
       * Essa é uma função crítica do sistema.
       */
      public function consolidarSaldo(){

            $imoveis = ImoveisService::getImoveisByUsuarioLogado();
            
            foreach ($imoveis as $imovel) {
                  $inquilinos_ativos = InquilinosService::getInquilinosAtivosByImovel($imovel);
                  
                  array_walk($inquilinos_ativos, function($inquilino){

                        $referencia_hoje = ProjectUtils::getAnoMesSistemaSemMascara();
                        $ano = ProjectUtils::getAnoFromReferencia($referencia_hoje);
                        $mes = ProjectUtils::getMesFromReferencia($referencia_hoje);


                        $saldo_anterior =  InquilinosService::getSaldoAnteriorBy($inquilino->id);
                        $soma_contas_mes_anterior = $this->getValoresSomadosMes($inquilino, $ano, $mes - 1);

                        $referencia_mes_anterior = $ano+''+$mes-1;

                        $saldo_mes_anterior = $this->getSaldo($soma_contas_mes_anterior, $inquilino, $referencia_mes_anterior);

                        $saldo_consolidado = $saldo_anterior + $saldo_mes_anterior;

                        $inquilino_saldo = InquilinosService::getInquilinoSaldoBy($inquilino);

                        $inquilino_saldo->saldo_atual = $saldo_consolidado;
                        $inquilino_saldo->saldo_anterior = $saldo_consolidado;

                        $inquilino_saldo->save();

                 });

                 // Para cada inquilino vai haver uma busca no saldo_anterior da tabela inquilinos_saldos
                 // Se o resultado dessa busca for nulo, a ele será atribuído o valor 0.0 
                 // Vai haver a busca do saldo do mês e ele será somado ao saldo_anterior 
                 // O resultado dessa soma será atribuído ao saldo_atual
            }
      }

}
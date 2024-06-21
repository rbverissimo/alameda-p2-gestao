<?php

namespace App\Services;

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


            $aluguel = InquilinosService::getAluguelAtualizado($inquilino_id);

            $conta_luz = $this->getValorInquilinoBy(2, $inquilino_id, $ano, $mes) != null ? 
                  $this->getValorInquilinoBy(2, $inquilino_id, $ano, $mes)->valorinquilino  : 0.0;

            $conta_agua = $this->getValorInquilinoBy(1, $inquilino_id, $ano, $mes) != null ?
                  $this->getValorInquilinoBy(1, $inquilino_id, $ano, $mes)->valorinquilino : 0.0;

            $total_contas = $this->somarContas($aluguel, $conta_luz, $conta_agua);

            $saldo = $this->getSaldoParcial($total_contas, $inquilino_id, $referencia);

            $saldo_mes = $this->getSaldoMes($inquilino_id, $referencia);

            $situacao_financeira = new SituacaoFinanceiraVO(
            ProjectUtils::adicionarMascaraReferencia($referencia), 
            $aluguel, 
            ProjectUtils::arrendondarParaDuasCasasDecimais($conta_luz), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($conta_agua), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($total_contas), 
            ProjectUtils::arrendondarParaDuasCasasDecimais($saldo),
            ProjectUtils::arrendondarParaDuasCasasDecimais($saldo_mes));

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


      private function somarContas($aluguel, $conta_luz, $conta_agua){
            return $aluguel + $conta_luz + $conta_agua;
      }

      /**
       * Esse método recebe o valor total de contas do mês e busca os comprovantes 
       * na tabela de comprovantes para um determinado inquilino representado pelo seu ID
       * Ainda, é feita uma consulta pelo saldo_atual na tabela inquilinos_saldos.
       * O retorno dessa função é a diferença do valor devido do mês menos os valores de comprovantes
       * somado ao saldo_nao_consolidado resultando em um saldo parcial do que é devido pelo inquilino
       * 
       * @return float
       * 
       */
      private function getSaldoParcial($valor_total_contas, $inquilino_id, $referencia){

            $valores_mes =  ComprovantesService::getSomaComprovantesReferencia($inquilino_id, $referencia);       
            $saldo_nao_consolidado = InquilinosService::getSaldoAtualBy($inquilino_id);
            $saldo_mes = $valores_mes - $valor_total_contas; 

            return $saldo_nao_consolidado + $saldo_mes;
      }


      /**
       * Retorna o saldo do mês através da conta entre valores pagos naquele mês
       * subtraídos dos valores devidos na mesm referência
       * 
       * @return float
       */
      private function getSaldoMes($inquilino_id, $referencia){

            $ano = ProjectUtils::getAnoFromReferencia($referencia);
            $mes = ProjectUtils::getMesFromReferencia($referencia);

            $valores_pagos_mes = ComprovantesService::getSomaComprovantesReferencia($inquilino_id, $referencia);
            $valores_devidos_mes = InquilinosService::getValoresSomadosMes($inquilino_id, $ano, $mes);

            return $valores_pagos_mes - $valores_devidos_mes; 
      }

      /**
       * Essa é uma função crítica do sistema.
       */
      public function consolidarSaldo(){

            $imoveis = ImoveisService::getImoveisByUsuarioLogado();
            
            foreach ($imoveis as $imovel) {
                  $inquilinos_ativos = InquilinosService::getInquilinosAtivosByImovel($imovel);
                  //dd($inquilinos_ativos);
                  foreach ($inquilinos_ativos as $inquilino) {

                        $inquilino_saldo = InquilinosService::getInquilinoSaldoBy($inquilino['id']);

                        $referencia_hoje = ProjectUtils::getAnoMesSistemaSemMascara();
                        $ano = ProjectUtils::getAnoFromReferencia($referencia_hoje);
                        $mes_anterior = ProjectUtils::getMesFromReferencia($referencia_hoje) - 1;


                        $saldo_anterior =  InquilinosService::getSaldoAnteriorBy($inquilino['id']);
                        $saldo_mes_anterior = $this->getSaldoMes($inquilino['id'], $ano * 100 + $mes_anterior);

                        $saldo_consolidado = $saldo_anterior + $saldo_mes_anterior;

                        //Update no objeto do banco de dados
                        if($inquilino_saldo == null){
                              $novo_saldo = new InquilinoSaldo();
                              $novo_saldo->inquilinocodigo = $inquilino['id'];
                              $novo_saldo->saldo_atual = 0.0;
                              $novo_saldo->saldo_anterior = ProjectUtils::arrendondarParaDuasCasasDecimais($saldo_consolidado);
                              $novo_saldo->save();
                        } else {
                              $inquilino_saldo_update = $inquilino_saldo;
                              $inquilino_saldo_update->saldo_atual = ProjectUtils::arrendondarParaDuasCasasDecimais($saldo_consolidado);
                              $inquilino_saldo_update->saldo_anterior = ProjectUtils::arrendondarParaDuasCasasDecimais($saldo_consolidado);
                              $inquilino_saldo_update->save();
                        }
                 };
            }
      }
}
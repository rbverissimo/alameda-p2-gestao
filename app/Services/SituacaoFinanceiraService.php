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

      public function buscarSituacaoFinanceira($inquilino_id, $referencia): SituacaoFinanceiraVO
      {

            $ano = ProjectUtils::getAnoFromReferencia($referencia);
            $mes = ProjectUtils::getMesFromReferencia($referencia);


            $aluguel = InquilinosService::getAluguelAtualizado($inquilino_id);
            $contas = $this->getValorInquilinoBy($inquilino_id, $ano, $mes);
            $saldo_atual = InquilinosService::getSaldoAtualBy($inquilino_id);
            
            $tupla_contas = [];
            $total = $aluguel;

            foreach ($contas as $conta) {
                  $tupla_contas[$conta->descricao] = ProjectUtils::arrendondarParaDuasCasasDecimais($conta->valorinquilino);
                  $total += $conta->valorinquilino;
            }

            $saldo_parcial = ComprovantesService::getSomaComprovantesReferencia($inquilino_id, $referencia) - $total;

            $vo = new SituacaoFinanceiraVO();
            $vo->setReferencia($referencia);
            $vo->setAluguel($aluguel);
            $vo->setTotalContasMensais($total);
            $vo->setContasInquilino($tupla_contas);
            $vo->setSaldoAtual($saldo_atual);
            $vo->setSaldoParcial($saldo_parcial);



            return $vo;

      }

      /**
       * Busca a descrição do tipo da conta e o valor da mesma para todas as contas
       * registradas de um determinado inquilino para o ano e o mês passados todos os
       * três atributos pelos parâmetros do método
       * 
       */
      public function getValorInquilinoBy($inquilino_id, $ano, $mes){
            return DB::table('inquilinos_contas')->select('tipocontas.descricao', 'contas_imoveis.tipocodigo', 'inquilinos_contas.valorinquilino')
                  ->join('contas_imoveis', 'inquilinos_contas.contacodigo', '=', 'contas_imoveis.id')
                  ->join('tipocontas', 'tipocontas.id', '=', 'contas_imoveis.tipocodigo')
                  ->where([
                        ['inquilinos_contas.inquilinocodigo', $inquilino_id], 
                        ['contas_imoveis.ano', $ano], 
                        ['contas_imoveis.mes', $mes]])
                  ->orderBy('contas_imoveis.id', 'desc')
                  ->get();
      }


      public function getContasDivididasEmRows($contas, $numero_contas_por_row = 4): array
      {
            $rows = array();
            if(!empty($contas)){
                  $counter = 0;
                  $row[] = array();
                  foreach ($contas as $key => $value) {
                        
                        if($counter > $numero_contas_por_row){
                              $slicedArray = array_slice($row, 1);
                              $rows[] = $slicedArray;
                              $row = [];
                              $counter = 0;                                    
                        }

                        $row[$key] =  $value;
                        $counter++;
                  }

                  if(!empty($row)){
                        $slicedArray = array_slice($row, 1);
                        $rows[] = $slicedArray;
                  }
            }

            return $rows;
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
            $saldo_atual = InquilinosService::getSaldoAtualBy($inquilino_id);
            $saldo_mes = $valores_mes - $valor_total_contas; 

            return $saldo_atual + $saldo_mes;
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
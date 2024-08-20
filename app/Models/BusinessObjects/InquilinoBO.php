<?php

namespace App\Models\BusinessObjects;

use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Utils\ProjectUtils;
use App\ValueObjects\DescricaoValorContaVO;
use App\ValueObjects\ResultadoCalculoContasVO;
use App\ValueObjects\SelectOptionVO;

class InquilinoBO {


      /**
       * Esse método fornece um snapshot do estado do inquilino
       * para a renderização na view app.detalhes-inquilino e é
       * baseada no form de cadastro do inquilino junto de seus dados
       * de contrato
       * 
       */
      public static function getDetalhesInquilino($idInquilino){
            $inquilino = InquilinosService::getDetalhesInquilino($idInquilino);
            $inquilino->imovel = ImoveisService::getImovelBySala($inquilino->salacodigo);
    
            $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();
            $imoveis = ImoveisService::getListaImoveisSelect();
            $salas = ImoveisService::getListaSalaSelectBy($inquilino->imovel);

            $contrato = InquilinosService::getContratoVigente($idInquilino);

            return ['inquilino' => $inquilino, 'imoveis' => $imoveis, 'salas' => $salas, 'contrato' => $contrato, 'imobiliarias' => $imobiliarias];
      }

      public static function getRegrasValidacao(){
            $regras = [
                  'data-assinatura' => 'required',
                  'valor-aluguel' => 'required',
                  'arquivo-contrato' => 'file',
                  'sala' => 'required|exists:salas,id',
                  'nome' => 'required',
                  'cpf' => 'required',
                  'telefone-celular' => 'required'
            ];
            
            $feedback = [
                  'sala.exists' => 'A sala informada é inválida. ',
                  'arquivo-contrato.file' => 'O contrato fornecido é inválido. ',
            
                  'required' => 'O :attribute é obrigatório.'
            ];

            return ['regras' => $regras, 'feedback' => $feedback];
      }

      public static function getDadosInquilinosContasCalculadosPor($imovel, $referencia){
            $inquilinos = InquilinosService::getIdNomeInquilinosAtivosByImovel($imovel);

            $ano_referencia = ProjectUtils::getAnoFromReferencia($referencia);
            $mes_referencia = ProjectUtils::getMesFromReferencia($referencia);

            foreach ($inquilinos as $inquilino) {
                $contas_inquilino = InquilinosService::buscarIdInquilinoContaByReferencia($inquilino->id, $ano_referencia, $mes_referencia);
                
                $inquilino->contas_inquilino = $contas_inquilino;
                $inquilino->valorAluguel = InquilinosService::getAluguelBy($inquilino->id, $referencia)->valorAluguel;

                $total_contas = array_reduce($contas_inquilino->toArray(), function($carry, $conta){
                        return $carry + (float) $conta['valorinquilino'];
                }, 0);

                $inquilino->total = $total_contas + $inquilino->valorAluguel;

                
            }


            return $inquilinos;
      }

      public static function gerarCardInquilinosContasCalculados($inquilinos){
            if(empty($inquilinos)){
                  return;
            }

            $calculos = [];

            foreach ($inquilinos as $inquilino) {
                  $contas_array = [];
                  foreach ($inquilino->contas_inquilino as $conta) {
                        $descricao_valor = new DescricaoValorContaVO($conta->descricao, $conta->valorinquilino);

                        $contas_array[] =$descricao_valor->getJson();
                  }
                  
                 $resultado_calculo = new ResultadoCalculoContasVO($inquilino->nome, $inquilino->valorAluguel, $inquilino->total, array_merge($contas_array));
                 $calculos[] = $resultado_calculo->getJson();

            }

            return $calculos; 
      }
}
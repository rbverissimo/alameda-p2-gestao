<?php

namespace App\Models\BusinessObjects;

use App\Services\ImoveisService;
use App\Services\InquilinosService;

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
    
            $imoveis = ImoveisService::getListaImoveisSelect();
            $salas = ImoveisService::getSalaBy($inquilino->imovel);
            $contrato = InquilinosService::getContratoVigente($idInquilino);

            return ['inquilino' => $inquilino, 'imoveis' => $imoveis, 'salas' => $salas, 'contrato' => $contrato];
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
}
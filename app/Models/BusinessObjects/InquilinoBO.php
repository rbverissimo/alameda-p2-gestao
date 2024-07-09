<?php

namespace App\Models\BusinessObjects;

class InquilinoBO {

      public static function getRegrasValidacao(){
            $regras = [
                  'data-assinatura' => 'required',
                  'valor-aluguel' => 'required',
                  'arquivo-contrato' => 'required|file',
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
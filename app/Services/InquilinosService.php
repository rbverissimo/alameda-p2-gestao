<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\InquilinoFatorDivisor;
use App\Models\InquilinoSaldo;

class InquilinosService {


      public static function getInquilinoBy($id){
            return Inquilino::find($id)->first();
      }

      public static function getInquilinoFatorDivisorBy($idInquilino){
            return InquilinoFatorDivisor::where('inquilino_id', $idInquilino)->first();
      }

      public static function getInquilinoNome($id) {
            
            $query = Inquilino::select('pessoas.nome')
                  ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
                  
            return $query->nome;
      }

      public static function getInquilinoIdFromComprovante($id_comprovante){
            $query = Comprovante::where('id', $id_comprovante)->first();
            return $query->inquilino;
      }

      public static function getInfoPainelInquilino($id){
            return Inquilino::select('pessoas.nome', 'inquilinos.id', 'salas.nomesala',
                  'inquilinos.salacodigo', 'inquilinos.qtdePessoasFamilia', 
                  'inquilinos.valorAluguel', 'pessoas.telefone_celular')
                  ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                  ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      public static function getDetalhesInquilino($id){
            return Inquilino::join('pessoas', 'pessoas.id', 'inquilinos.pessoacodigo')
                  ->join('inquilinos_fator_divisor', 'inquilinos_fator_divisor.id', 'inquilinos.id')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      public static function getInquilinosByImovel($idImovel){
            return Inquilino::select('inquilinos.id')
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->where('salas.imovelcodigo', $idImovel)
                  ->get();
      }

      public static function getInquilinosAtivosByImovel($idImovel){
            return array_filter(InquilinosService::getInquilinosByImovel($idImovel), function($inquilino){
                  return $inquilino['situacao'] == 'A';
            });
      }

      /**
       * Busca o saldo anterior já consolidado do Inquilino. 
       * Se não houver um saldo, retorna 0.0. 
       * 
       * 
       * @return saldo_anterior do inquilino
       */
      public static function getSaldoAnteriorBy($inquilino){
            $saldo = InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();

            return $saldo->saldo_anterior != null ? $saldo->saldo_anterior : 0.0; 
      }

}
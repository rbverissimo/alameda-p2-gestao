<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\InquilinoFatorDivisor;
use App\Models\InquilinoSaldo;

class InquilinosService {


      /**
       * Busca o registro na tabela de inquilinos de acordo com o ID
       * 
       * @return Inquilino
       */
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

      /**
       * Busca no banco de dados informações relevantes para a composição do painel
       * do inquilino. Essas informações são as tais: id da tabela de inquilinos, nome relacionado
       * à tabela de pessoas, nome da sala do imóvel que o inquilino está alocado, o id dessa sala,
       * a quantidade de pessoas na família, valor do Aluguel e o telefone celular dessa pessoa. 
       * 
       * @return Inquilino
       */
      public static function getInfoPainelInquilino($id){
            return Inquilino::select('pessoas.nome', 'inquilinos.id', 'salas.nomesala',
                  'inquilinos.salacodigo', 'inquilinos.qtdePessoasFamilia', 
                  'inquilinos.valorAluguel', 'pessoas.telefone_celular')
                  ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                  ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      /**
       * Busca no banco de dados a pessoa associada ao inquilino e o fator divisor do mesmo
       * 
       */
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

      /**
       * Traz todos os inquilinos de um imóvel independente de estarem ativos ou não
       * 
       */
      public static function getInquilinosBy($imovel){

            return Inquilino::select('inquilinos.id', 'inquilinos.situacao', 'inquilinos.valoraluguel')
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->where('salas.imovelcodigo', $imovel->idImovel)
                  ->get();
      }

      public static function getInquilinosAtivosByImovel($idImovel){
            return array_filter(InquilinosService::getInquilinosBy($idImovel)->toArray(), function($inquilino){
                  return $inquilino['situacao'] === 'A';
            });
      }

      /**
       * Busca o saldo anterior já consolidado do Inquilino. 
       * Se não houver um saldo, retorna 0.0. 
       * 
       * 
       * @return float saldo anterior salvo na tabela inquilinos_saldos de acordo com o  inquilino
       */
      public static function getSaldoAnteriorBy($inquilino){
            $saldo = InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();

            $saldo_anterior = 0.0;
            if($saldo != null){
                  $saldo_anterior = $saldo->saldo_anterior != null ? $saldo->saldo_anterior : 0.0; 
            }

            return  $saldo_anterior;
      }

      /**
       * Busca o saldo atual ainda não consolidado do Inquilino. 
       * Se não houver um saldo, retorna 0.0. 
       * 
       * 
       * @return float saldo anterior salvo na tabela inquilinos_saldos de acordo com o  inquilino
       */
      public static function getSaldoAtualBy($inquilino){
            $saldo = InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();
            return $saldo ? $saldo->saldo_atual : 0.0;
      }


      /**
       * Busca através do ID do inquilino o saldo na tabela inquilinos_saldo
       * @return InquilinoSaldo retorna uma instância do objeto InquilinoSaldo extraído do banco de dados
       */
      public static function getInquilinoSaldoBy($inquilino){
            return InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();
      }

}
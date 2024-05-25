<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\TipoComprovante;

class ComprovantesService {


      public static function getTiposComprovantes(){
            return TipoComprovante::all();
      }

      public static function getComprovante($id){
            return Comprovante::find($id);
      }

      /**
       * Busca todos os comprovantes de um determinado inquilino de acordo com uma referência
       * 
       * @return App\Models\Comprovante
       */
      public static function getComprovantesBy($idInquilino, $referencia){
            return Comprovante::where('inquilino', $idInquilino)
                  ->where('referencia', $referencia)
                  ->get();
      }

      /**
       * Esse método busca na tabela de comprovantes a soma dos valores 
       * de todos comprovantes dada uma determinada referência para um 
       * determinado inquilino
       * 
       * @return float
       */
      public static function getSomaComprovantesReferencia($inquilino_id, $referencia){
            return Comprovante::select('valor')
            ->where('inquilino', $inquilino_id)
            ->where('referencia', $referencia)
            ->sum('valor');
      }
      
}
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
       * @return App\Models\Comprovante
       */
      public static function getComprovantesBy($idInquilino, $referencia){
            return Comprovante::where('inquilino', $idInquilino)
                  ->where('referencia', $referencia)
                  ->get();
      }
      
}
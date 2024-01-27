<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\TipoComprovante;

class ComprovantesService {


      public static function getTiposComprovantes(){
            return TipoComprovante::all();
      }

      public static function getComprovante($id){
            return Comprovante::where('id', $id)->first();
      }
      
}
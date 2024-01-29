<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\Inquilino;

class InquilinosService {

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

}
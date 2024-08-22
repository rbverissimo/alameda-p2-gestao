<?php

namespace App\Services;

use App\Models\Imobiliaria;
use App\Models\User;
use App\Models\UsuarioImovel;

class UsuarioService {

      public static function getUsuarioLogado() {
            $name = $_SESSION['nome'];
            $email = $_SESSION['email'];

            $usuario_logado = User::where('name', $name)
                              ->where('email', $email)
                              ->first();

            return $usuario_logado->id;
      }

      /**
       * Retorna um array com os ID de todos os imóveis que um usuário possui
       * @deprecated os imóveis devem ser filtrados através da imobiliária
       */
      public static function getImoveisBy($usuario){
            $usuario_imoveis = UsuarioImovel::select('idImovel')
                  ->where('idUsuario', $usuario)
                  ->groupBy('idImovel')
                  ->get();
            return $usuario_imoveis->pluck('idImovel')->toArray();
      }

      public static function getImobiliarias(){
            $usuario = UsuarioService::getUsuarioLogado();
            return Imobiliaria::where('usuario_id', $usuario)
                  ->pluck('id');
      }

}
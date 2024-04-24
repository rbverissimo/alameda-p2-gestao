<?php

namespace App\Services;

use App\Models\User;

class UsuarioService {

      public static function getUsuarioLogado() {
            $name = $_SESSION['nome'];
            $email = $_SESSION['email'];

            $usuario_logado = User::where('name', $name)
                              ->where('email', $email)
                              ->first();

            return $usuario_logado->id;
      }

}
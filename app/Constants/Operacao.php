<?php

namespace App\Constants;

class Operacao {

    public const SALVAR = 'salvar';
    public const RENDERIZAR = 'renderizar';
    public const NORMALIZAR = 'normalizar';

    public static function getAll(): array
    {
      return [
          self::SALVAR,
          self::RENDERIZAR,
          self::NORMALIZAR
      ];
    }

    public static function isValid(string $status): bool
    {
      return in_array($status, self::getAll());
    }

}

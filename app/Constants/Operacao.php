<?php

namespace App\Constants;

class Operacao {

    public const SALVAR = 'salvar';
    public const RENDERIZAR = 'renderizar';

    public static function getAll(): array
    {
      return [
          self::SALVAR,
          self::RENDERIZAR,
      ];
    }

    public static function isValid(string $status): bool
    {
      return in_array($status, self::getAll());
    }

}

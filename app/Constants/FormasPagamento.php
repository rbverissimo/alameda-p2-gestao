<?php

namespace App\Constants;

class FormasPagamento {

    public const CREDITO = '10001';
    public const DEBITO = '10002';
    public const PIX = '10003';

    public static function getAll(): array
    {
      return [
          self::CREDITO,
          self::DEBITO,
          self::PIX
      ];
    }

    public static function isValid(string $status): bool
    {
      return in_array($status, self::getAll());
    }
}
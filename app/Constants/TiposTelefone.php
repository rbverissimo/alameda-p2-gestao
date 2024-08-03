<?php

namespace App\Constants;

class TiposTelefone {

    public const CELULAR = 1010;
    public const RESIDENCIAL = 1000;
    public const TRABALHO = 1020;

    public static function getAll(): array
    {
        return [
            self::CELULAR,
            self::RESIDENCIAL,
            self::TRABALHO
        ];
    }

    public static function isValid($telefone): bool
    {
        return in_array($telefone, self::getAll());
    }

}
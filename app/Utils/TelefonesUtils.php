<?php

namespace App\Utils;

use InvalidArgumentException;

class TelefonesUtils{

    public static function getDddTelefone($telefone): array
    {
        try {
           $telefone_size = mb_strlen($telefone);
           if($telefone_size < 10){
            throw new InvalidArgumentException('O número de telefone fornecido está incorreto.');
           }

           $ddd = substr($telefone, 0, 2);
           $telefone = substr($telefone, 2);

           return [ 'ddd' => $ddd, 'telefone' => $telefone];

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}


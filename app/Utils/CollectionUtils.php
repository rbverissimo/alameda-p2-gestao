<?php

namespace App\Utils;

class CollectionUtils {


    public static function getAssociativeArray($collection, $separator = '-', int $index_identificador, $pattern){
        return collect($collection)->filter(function($value, $key) use ($pattern){
            return str_starts_with($key, $pattern);
        })->mapWithKeys(function($value, $key) use ($separator, $index_identificador){
            $identificador = (int) explode($separator, $key)[$index_identificador];
            return [$identificador => $value];
        })
        ->toArray();
    }

}
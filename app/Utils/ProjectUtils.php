<?php

class ProjectUtils {


      public static function getDataHojeSistema(){
            return date('Y-m-d');
      }

      public static function getAnoMesSistemaSemMascara(){
            return str_replace('-', '', ProjectUtils::getAnoMesSistema());
      }

      public static function getAnoMesSistema(){
            return date('Y-m');
      }

      public static function getAnoFromReferencia($referencia){
            return floor($referencia / 100);
      }

      public static function getMesFromReferencia($referencia){
            return $referencia % 100; 
      }

      public static function adicionarMascaraReferencia($referencia){
            $ano = substr($referencia, 0, 4);
            $mes = substr($referencia, 4, 2);

            return $ano.'-'.$mes;
      }

      public static function arrendondarParaDuasCasasDecimais($valor){
            return number_format($valor, 2);
      }

      public static function getMaxID($collection){
            return max(array_map(function($item) {
                  return $item->id;
            }, $collection));
      }

      public static function getContasByTipo($contas, $tipoconta){
            return array_filter($contas, function($conta) use ($tipoconta){
                  return $conta->tipocodigo === $tipoconta;
            });
      }

      public static function getContasBySala($contas, $salacodigo){
            return array_filter($contas, function($conta) use ($salacodigo){
                  return $conta->salacodigo === $salacodigo;
            });
      }
}
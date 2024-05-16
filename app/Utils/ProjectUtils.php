<?php

namespace App\Utils;

use DateTime;

class ProjectUtils {


      public static function getDataHojeSistema(){
            return date('Y-m-d');
      }

      /**
       * Retorna a referência porém sem a máscara.
       * Ao invés de retornar, digamos, 2024-05, esse método retornará 202405
       */
      public static function getAnoMesSistemaSemMascara(){
            return str_replace('-', '', ProjectUtils::getAnoMesSistema());
      }

      /**
       * Retorna o anoMês (ou seja, a referência) que o sistema lê
       */
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

      /**
       * Ao fornecer um array de Contas identificáveis por seu tipo, esse método
       * filtra as contas retornando um novo array de acordo com tipo passado no 
       * parâmetro da função
       */
      public static function getContasByTipo($contas, $tipoconta){
            return array_filter($contas, function($conta) use ($tipoconta){
                  return $conta->tipocodigo === $tipoconta;
            });
      }

      /**
       * Dado um array de contas retorna um array de contas com o código indicado na chamada * do método
       */
      public static function getContasBySala($contas, $salacodigo){
            return array_filter($contas, function($conta) use ($salacodigo){
                  return $conta->salacodigo === $salacodigo;
            });
      }

      public static function tirarMascara($stringComMascara){
            $caracteres = array('/', '-', '_', '.');
            $stringSemMascara = str_replace($caracteres, '', $stringComMascara);
            return $stringSemMascara;
      }

      public static function trocarVirgulaPorPonto($valor){
            return str_replace(',', '.', $valor);
      }

      public static function trocarPontoPorVirgula($valor){
            return str_replace('.', ',', $valor);
      }

      public static function inverterDataParaSalvar($data){
            return date('Y-m-d', strtotime($data));
      }

      public static function inverterDataParaRenderizar($data){
            return date('d-m-Y', strtotime($data));
      }

      public static function converterMes($mes){
            $resultado = '';
            switch($mes){
                  case 1:
                        $resultado = 'Janeiro';
                        break;
                  case 2:
                        $resultado = 'Fevereiro';
                        break;
                  case 3:
                        $resultado = 'Março';
                        break;
                  case 4:
                        $resultado = 'Abril';
                        break;
                  case 5:
                        $resultado = 'Maio';
                        break;
                  case 6:
                        $resultado = 'Junho';
                        break;
                  case 7:
                        $resultado = 'Julho';
                        break;
                  case 8:
                        $resultado = 'Agosto';
                        break;
                  case 9:
                        $resultado = 'Setembro';
                        break;
                  case 10:
                        $resultado = 'Outubro';
                        break;
                  case 11:
                        $resultado = 'Novembro';
                        break;
                  case 12:
                        $resultado = 'Dezembro';
                        break;
                  default:
                        return $mes;
            }

            return $resultado; 
      }

}
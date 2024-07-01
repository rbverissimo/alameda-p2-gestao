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

      /**
       * Esse método recebe uma string representando uma data
       * como 20-12-2023 e extrai dela apenas a referência
       * 
       * @return int a referência extraída da data
       */
      public static function getReferenciaFromDate($dateString){
           $data = explode('-', $dateString, 3);
           $mes = intval($data[1]);
           $ano = intval($data[2]);
           return $ano * 100 + $mes;
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

      /**
       * Esse método retorna uma máscara limpa de caractéres de forma otimizada
       * através do uso explícito de regex e com a possibilidade de escolher
       * quais caractéres serão retirados da string original
       * 
       */
      public static function removerMascara($str_mascara, $caracteres = ".-/"){
            $regex = "/[$caracteres]/";
            return preg_replace($regex, "", $str_mascara);
      }

      public static function tirarMascara($stringComMascara){
            $caracteres = array('/', '-', '_', '.');
            $stringSemMascara = str_replace($caracteres, '', $stringComMascara);
            return $stringSemMascara;
      }

      /**
       * Esse método recebe uma string representando o CNPJ 
       * e adiciona a máscara de CNPJ à mesma. Existe uma validação
       * em relação ao número de dígitos para garantir o funcionamento
       * da função e facilitar no debug da mesma
       */
      public static function mascaraCnpj($cnpj) {
            $cnpj = preg_replace('/\D/', '', $cnpj);

            if(strlen($cnpj) !== 14){
                  throw new InvalidArgumentException('O CNPJ não possui os 14 dígitos necessários. ');
            }

            $mascara = "##.###.###/####-##";
            $resultado = "";
            $i = 0;
            for ($j = 0; $j < strlen($mascara); $j++) {
              if (isset($mascara[$j]) && $mascara[$j] == "#") { // Check for equality with "#"
                if (isset($cnpj[$i])) {
                  $resultado .= $cnpj[$i];
                  $i++;
                }
              } else {
                $resultado .= $mascara[$j];
              }
            }
          
            return $resultado;
      }

      public static function retirarMascaraMoeda($valor){
            $valor_sem_mascara = ProjectUtils::trocarVirgulaPorPonto($valor);
            return str_replace('R$', '', $valor_sem_mascara);
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
<?php

namespace App\Utils;

class CollectionUtils {


    /**
     * O caso de uso ideal deste método é: 
     * tendo um array de inputs coletado do front-end em mãos (possível de ser adquirido pelo $request->input()),
     * esse array de inputs é passado como a collection do primeiro parâmetro deste método. 
     * Os inputs são reconhecidos pelos seus atributos name que, geralmente, são nomeados separando os nomes por um hífen. 
     * Este é o segundo parâmetro. O terceiro parâmetro se refere a um identificador único, geralmente um número aleatório, 
     * e o quarto é o padrão de palavras que será buscado no array de inputs. Em um exemplo:
     * 
     * getAssociativeArray(inputs, '-', 3, 'exemplo-input-dado');
     * o método vai buscar no array de inputs, inputs com o name começando com 'exemplo-input-dado' e vai retornar 
     * um array associativo com o identificador => valor-do-input. 
     * Vamos supor que o array de inputs possui os seguintes nomes de input: exemplo-input-dado-123 e exemplo-input-dado-456 
     * O array retornado será: 
     * 
     * 123 => <valor-do-input>
     * 456 => <valor-do-input>
     * 
     * @return array
     */
    public static function getAssociativeArray($collection, $separator = '-', int $index_identificador, $pattern): array
    {
        return collect($collection)->filter(function($value, $key) use ($pattern){
            return str_starts_with($key, $pattern);
        })->mapWithKeys(function($value, $key) use ($separator, $index_identificador){
            $identificador = (int) explode($separator, $key)[$index_identificador];
            return [$identificador => $value];
        })
        ->toArray();
    }

    public static function mergirArraysByChaves($arr1, $arr2, $arr1_key, $arr2_key)
    {
        return array_map(function($valueArr1, $valueArr2) use ($arr1_key, $arr2_key){
            return [$arr1_key => $valueArr1, $arr2_key => $valueArr2];
        }, $arr1, $arr2);
    }

    public static function getPrimeiroValorParaQualquerChave($collection){

        if(empty($collection)){
            return $collection;
        }

        $primeiros_valores = [];
        $valores_vistos = [];

        foreach ($collection as $chave => $valor) {
            if(!isset($valores_vistos[$valor])){
                $valores_vistos[$valor] = true;
                $primeiros_valores[$chave] = $valor;
            }
        }
        
        return $primeiros_valores;
    }


    /**
     * O caso de uso ideal deste método é:
     * Em um update de uma tabela que possui uma relação 1-N de forma que seja possível colher valores antigos e valores novos 
     * dessa relação a fim de atualizar as relações entre os registros, é passado como o array left (da esquerda) o array de valores
     * antigos (já consolidados no banco de dados) e na direita (right) todos os valores novos (que foram colhidos do front-end, contendo todos os valores
     * adicionados, removidos e não modificados). A operação do método reflete as seguintes operações de conjuntos:
     * 
     * Dados conjuntos L e R
     * O que excluir? L - (L intersecção R)
     * O que adicionar? R - (L intersecção R)
     * 
     * Ou seja, será excluído tudo aquilo que sobrar em L da intersecção entre L e R 
     * e será adicionado tudo aquilo que sobrar em R da intesecção  entre L e R. 
     * 
     */
    public static function getValoresAdicionarExcluir(array $left, array $right): array
    {
        $excluir = array_diff($left, array_intersect($left, $right));
        $adicionar = array_diff($right, array_intersect($right, $left));
        
        return [
            'excluir' => $excluir,
            'adicionar' => $adicionar
        ];
    }

}
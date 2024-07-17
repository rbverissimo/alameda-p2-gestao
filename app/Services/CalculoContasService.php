<?php

namespace App\Services;

use App\Models\ContaImovel;
use App\Models\InquilinoConta;
use App\Utils\ProjectUtils;
use App\ValueObjects\CalculoContasVO;

class CalculoContasService {


    public static function getContaBy($id){
        return ContaImovel::with('sala')->where('id', $id)->first();
    }

    /**
     * Esse método realiza a parte central da divisão das contas do imóvel
     * para os inquilinos do imóvel 
     * 
     */
    public function calcularContasInquilinos($idImovel, $periodo_referencia){

        $ano_referencia = ProjectUtils::getAnoFromReferencia($periodo_referencia);
        $mes_referencia = ProjectUtils::getMesFromReferencia($periodo_referencia);
        $inquilinos_imovel = InquilinosService::getInquilinosByImovel($idImovel);

        foreach ($inquilinos_imovel as $inquilino) {
            $contas_ja_calculadas = InquilinosService::buscarIdInquilinoContaByReferencia($inquilino->id, $ano_referencia, $mes_referencia);
            if(!$contas_ja_calculadas->isEmpty()){
                foreach ($contas_ja_calculadas as $conta_calculada) {
                    InquilinoConta::where('id', $conta_calculada->id)->delete();
                }
            }
        }

        $contas_imovel = ImoveisService::getContasAnoMes($ano_referencia, $mes_referencia, $idImovel);
        $this->inserirCalculoContasInquilinos($this->gerarSalasCalculcoVO($contas_imovel), $idImovel);

        
    }

    public function inserirCalculoContasInquilinos($salas_calculoVO, $idImovel){
        foreach($salas_calculoVO as $key => $value){
            $vo = $value;

            $inquilinos = $value->getInquilinos();
            $numero_inquilinos_sala = count($inquilinos);
            $contas = $value->getContasSala();
            
            if($numero_inquilinos_sala > 0){


                foreach ($inquilinos as $inquilino) {

                    $fatorDivisor = InquilinosService::getInquilinoFatorDivisorBy($inquilino);

                    foreach($contas as $conta){
                        
                        $valor_inquilino = ($conta->valor / $numero_inquilinos_sala) * $fatorDivisor; 
                        
                        InquilinoConta::create([
                            'inquilinocodigo' => $inquilino,
                            'contacodigo' => $conta->id,
                            'valorinquilino' => $valor_inquilino,
                            'dataVencimento' => $conta->dataVencimento,
                        ]);
                    }
                    
                }
            } else {

                $inquilinos_imovel = InquilinosService::getInquilinosByImovel($idImovel);

                foreach($inquilinos_imovel as $inquilino){

                    $fatorDivisor = InquilinosService::getInquilinoFatorDivisorBy($inquilino->id);

                    foreach ($contas as $conta) {
                        $isFatorDivisor = TipoContasService::isTipoContaFatorDivisor($conta->tipocodigo);
                        $valor_inquilino = ($conta->valor / count($inquilinos_imovel->toArray()));

                        if($isFatorDivisor){
                            $valor_inquilino = $valor_inquilino * $fatorDivisor;
                        }

                        InquilinoConta::create([
                            'inquilinocodigo' => $inquilino->id,
                            'contacodigo' => $conta->id,
                            'valorinquilino' => $valor_inquilino,
                            'dataVencimento' => $conta->dataVencimento,
                        ]);
                        
                    }
                }
            }

        }
    }

    public function atualizarCalculoContasInquilinos($idSala, $idContaImovel){

        $contas = InquilinosService::getContasInquilinoBySala($idSala, $idContaImovel);
        $numero_inquilinos = count($contas);
        $valor_atualizado_conta_imovel = ImoveisService::getContaImovelValorById($idContaImovel);
        $is_conta_fator_divisor = TipoContasService::isTipoContaFatorDivisorByContaImovel($idContaImovel);

        foreach ($contas as $conta) {
            $fator_divisor = InquilinosService::getInquilinoFatorDivisorBy($conta->inquilinocodigo);
            $conta->valorinquilino = ($valor_atualizado_conta_imovel / $numero_inquilinos) * $fator_divisor;
            $conta->calculo_json = '';
            $conta->save();
        }


    }

    public function gerarSalasCalculcoVO($contas_imovel)
    {
        $salas_calculoVO = [];
        foreach ($contas_imovel as $conta) {
            $sala = $conta->salacodigo;
             if(!array_key_exists($sala, $salas_calculoVO)){
 
                 $inquilinos = InquilinosService::getInquilinosBySala($sala)->toArray();
                 $contas = [$conta];
                 $vo = new CalculoContasVO($sala, $inquilinos, $contas);
                 $salas_calculoVO[$sala] = $vo;
 
             } else {
                 $vo = $salas_calculoVO[$sala];
                 $vo->contas_sala[] = $conta;
             }
            
        }

        return $salas_calculoVO;
    }

}

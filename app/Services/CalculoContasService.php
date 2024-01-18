<?php

namespace App\Services;

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;
use App\Models\InquilinoFatorDivisor;

class CalculoContasService {

    public function calcularContasInquilinos(){

        $conta_agua = ContaImovel::where('tipocodigo', 1)->orderByDesc('id')->first();

        $conta_luz_sala1 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 1)->orderByDesc('id')->first();

        $conta_luz_sala2 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 2)->orderByDesc('id')->first();

        $conta_luz_sala3 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 3)->orderByDesc('id')->first();

        $fator_casa_3 = $this->getFatorCasa3($conta_luz_sala3->valor);

        $inquilinos = Inquilino::where('situacao', 'A')->get();

        foreach($inquilinos as $inquilino){

            $fator_divisor = InquilinoFatorDivisor::where('inquilino_id', $inquilino->id)->orderByDesc('id')->limit(1)->first();
            
            switch($inquilino->salacodigo){
                case 1:
                    $valor_conta = $this->calculoEnergiaCasa1($conta_luz_sala1->valor, $fator_casa_3, $fator_divisor->fatorDivisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala1->id,
                        'valorinquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala1->dataVencimento
                    ]);
                    break;
                case 2:
                    $valor_conta = $this->calculoEnergiaCasa2($conta_luz_sala2->valor, $fator_casa_3, $fator_divisor->fatorDivisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala2->id,
                        'valorinquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala2->dataVencimento
                    ]);
                break;
                case 3:
                    break;
            }

            $valor_conta_agua = $this->calculoAgua($conta_agua->valor, $fator_divisor->fatorDivisor);
            InquilinoConta::create([
                'inquilinocodigo' => $inquilino->id,
                'contacodigo'=>$conta_agua->id,
                'valorinquilino'=>$valor_conta_agua,
                'dataVencimento'=>$conta_agua->dataVencimento
            ]);
        }
    }

    private function getFatorCasa3($valor_casa_3){
        return $valor_casa_3 / 3;
    }

    private function calculoEnergiaCasa1($energia_casa_1, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_1 / 3) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoEnergiaCasa2($energia_casa_2, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_2 / 2) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoAgua($conta_agua, $fator_divisor){
        return ($conta_agua / 5) * $fator_divisor;
    }

}

<?php

namespace App\Services;

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;
use App\Models\InquilinoFatorDivisor;

class CalculoContasService {

    public function calcularContasInquilinos(){

        $conta_agua = ContaImovel::where('tipocodigo', 1)->orderByDesc('id')->limit(1);

        $conta_luz_sala1 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 1)->orderByDesc('id')->limit(1)->get();

        $conta_luz_sala2 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 2)->orderByDesc('id')->limit(1)->get();

        $conta_luz_sala3 = ContaImovel::where('tipocodigo', 2)->where('salacodigo', 3)->orderByDesc('id')->limit(1)->get();

        $fator_casa_3 = $this->getFatorCasa3($conta_luz_sala3->valor);

        $inquilinos = Inquilino::where('situacao', 'A')->get();

        foreach($inquilinos as $inquilino){

            $fator_divisor = InquilinoFatorDivisor::where('id', $inquilino->id)->orderByDesc('id')->limit(1)->get();
            
            switch($inquilino->salacodigo){
                case 1:
                    $valor_conta = $this->calculoEnergiaCasa1($conta_luz_sala1->valor, $fator_casa_3, $fator_divisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala1->id,
                        'valorInquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala1->dataVencimento
                    ]);
                    break;
                case 2:
                    $valor_conta = $this->calculoEnergiaCasa2($conta_luz_sala2->valor, $fator_casa_3, $fator_divisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala2->id,
                        'valorInquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala2->dataVencimento
                    ]);
                break;
                case 3:
                    break;
            }

            $valor_conta_agua = $this->calculoAgua($conta_agua, $fator_divisor);
            Inquilino::create([
                'inquilinocodigo' => $inquilino->id,
                'contacodigo'=>$conta_agua->id,
                'valorInquilino'=>$valor_conta_agua,
                'dataVencimento'=>$conta_agua->dataVencimento
            ]);
        }

        // Como é feito o cálculo no billing_app
        /* double calculoEnergiaCasa1(double energiaCasa1, double fatorCasa3, double fatorCorretivo){
	
            double divisaoDaConta = ((energiaCasa1 / 3) * fatorCorretivo) + fatorCasa3; 
            
            return divisaoDaConta;
                
        }
        
        double calculoEnergiaCasa2(double energiaCasa2, double fatorCasa3, double fatorCorretivo) {
            
            double divisaoDaConta = ((energiaCasa2 / 2) * fatorCorretivo) + fatorCasa3;
            
            return divisaoDaConta;
            
        }
        
        // fator da casa 3
        double divisaoCasa3(double energiaCasa3) {
            
            double divisaoDaConta = energiaCasa3 / 5; 
            
            return divisaoDaConta; 
        }
        
        double calculoAgua(double contaAgua, double fatorCorretivo){
            
            double divisaoDaConta = (contaAgua / 5) * fatorCorretivo; 
            
            return divisaoDaConta;
        } */
    }

    private function getFatorCasa3($valor_casa_3){
        return $valor_casa_3 / 3;
    }

    private function calculoEnergiaCasa1($energia_casa_1, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_1 / 3) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoEnergiaCasa2($energia_casa_2, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_2 / 3) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoAgua($conta_agua, $fator_divisor){
        return ($conta_agua / 5) * $fator_divisor;
    }

}

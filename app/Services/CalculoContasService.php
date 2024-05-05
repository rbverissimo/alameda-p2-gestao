<?php

namespace App\Services;

use App\Models\ContaImovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;
use App\Models\InquilinoFatorDivisor;
use App\Utils\ProjectUtils;

class CalculoContasService {


    public static function getContaBy($id){
        return ContaImovel::find($id);
    }

    public function calcularContasInquilinos($idImovel, $periodo_referencia){

        $inquilinos_imovel = InquilinosService::getInquilinosByImovel($idImovel);
        /*
            PASSO 1: Checar para cada id de Inquilino do imóvel se já existe um registro para a referência informada
                na tabela inquilinos_contas
            PASSO 2: Havendo, esses registros serão excluídos e inseridos novos registros de acordo com o fluxo abaixo; 
        */

        $ano_referencia = ProjectUtils::getAnoFromReferencia($periodo_referencia);
        $mes_referencia = ProjectUtils::getMesFromReferencia($periodo_referencia);

        $conta_agua = ContaImovel::where('tipocodigo', 1)
            ->where('ano', $ano_referencia)
            ->where('mes', $mes_referencia)
            ->get();

        $soma_valor_conta_agua = $conta_agua->sum('valor');

        $conta_luz_sala1 = ContaImovel::where('tipocodigo', 2)
            ->where('salacodigo', 1)->where('ano', $ano_referencia)
            ->where('mes', $mes_referencia)
            ->get();

        $soma_valor_luz_sala_1 = $conta_luz_sala1->sum('valor');

        $conta_luz_sala2 = ContaImovel::where('tipocodigo', 2)
            ->where('salacodigo', 2)->where('ano', $ano_referencia)
            ->where('mes', $mes_referencia)
            ->get();

        $soma_valor_luz_sala_2 = $conta_luz_sala2->sum('valor');

        $conta_luz_sala3 = ContaImovel::where('tipocodigo', 2)
            ->where('salacodigo', 3)->where('ano', $ano_referencia)
            ->where('mes', $mes_referencia)
            ->get();

        $soma_valor_luz_sala_3 = $conta_luz_sala3->sum('valor');

        
        $inquilinos = Inquilino::where('situacao', 'A')->get();
        
        $inquilinos_sala1 = $inquilinos->filter(function($item) {
            return $item->salacodigo == 1;
        });

        
        $inquilinos_sala2 = $inquilinos->filter(function($item) {
            return $item->salacodigo == 2;
        });
        
        $numero_inquilinos_sala1 = count($inquilinos_sala1);
        $numero_inquilinos_sala2 = count($inquilinos_sala2);
        $fator_casa_3 = $this->getFatorCasa3($soma_valor_luz_sala_3, $numero_inquilinos_sala1 + $numero_inquilinos_sala2);
        
        foreach($inquilinos as $inquilino){

            $fator_divisor_inquilino = InquilinoFatorDivisor::where('inquilino_id', $inquilino->id)->orderByDesc('id')->first();
            
            switch($inquilino->salacodigo){
                case 1:
                    $valor_conta = $this->calculoEnergiaCasa1($soma_valor_luz_sala_1, $numero_inquilinos_sala1,
                         $fator_casa_3, $fator_divisor_inquilino->fatorDivisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala1[0]->id,
                        'valorinquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala1[0]->dataVencimento
                    ]);
                    break;
                case 2:
                    $valor_conta = $this->calculoEnergiaCasa2($soma_valor_luz_sala_2, $numero_inquilinos_sala2, 
                        $fator_casa_3, $fator_divisor_inquilino->fatorDivisor);
                    InquilinoConta::create([
                        'inquilinocodigo' => $inquilino->id,
                        'contacodigo'=>$conta_luz_sala2[0]->id,
                        'valorinquilino'=>$valor_conta,
                        'dataVencimento'=>$conta_luz_sala2[0]->dataVencimento
                    ]);
                    break;
            }

            $valor_conta_agua = $this->calculoAgua($soma_valor_conta_agua, $numero_inquilinos_sala1 + $numero_inquilinos_sala2, 
                $fator_divisor_inquilino->fatorDivisor);
            InquilinoConta::create([
                'inquilinocodigo' => $inquilino->id,
                'contacodigo'=>$conta_agua[0]->id,
                'valorinquilino'=>$valor_conta_agua,
                'dataVencimento'=>$conta_agua[0]->dataVencimento
            ]);
        }
    }

    private function getFatorCasa3($valor_casa_3, $nr_inquilinos_imovel){
        return $valor_casa_3 / $nr_inquilinos_imovel;
    }

    private function calculoEnergiaCasa1($energia_casa_1, $nr_inquilinos_sala1, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_1 / $nr_inquilinos_sala1) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoEnergiaCasa2($energia_casa_2, $nr_inquilinos_sala2, $fator_casa_3, $fator_divisor){
        return  (($energia_casa_2 / $nr_inquilinos_sala2) * $fator_divisor) + $fator_casa_3;
    }

    private function calculoAgua($conta_agua, $nr_inquilinos_imovel, $fator_divisor){
        return ($conta_agua / $nr_inquilinos_imovel) * $fator_divisor;
    }

}

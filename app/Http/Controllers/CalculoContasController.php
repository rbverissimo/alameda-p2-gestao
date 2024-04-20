<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {


        $tipos_contas = TipoConta::all();
        $tipos_salas = Sala::all();

        if($request->isMethod('post')){

            $tipo_conta = $request->input('tipo_conta');

            $conta_imovel = new ContaImovel();
            $conta_imovel->valor = $request->input('valor-conta');
            $conta_imovel->ano = $request->input('ano');
            $conta_imovel->mes = $request->input('mes');
            $conta_imovel->dataVencimento = $request->input('data-vencimento');
            $conta_imovel->referenciaConta = $request->input('referencia');
            $conta_imovel->nrDocumento = $request->input('numero-documento');
            $conta_imovel->tipocodigo = $tipo_conta;

            if($tipo_conta === '2'){
                $conta_imovel->salacodigo = $request->input('sala');
            }

            $conta_imovel->save();


            $calculo_contas_service = new CalculoContasService();
            // $calculo_contas_service->calcularContasInquilinos();
        }

        $titulo = 'Calcular Contas';
        
        return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas'));
    }
}

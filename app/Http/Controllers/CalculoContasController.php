<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {

        $conta_imovel = null;
        $mensagem = null;
        $tipos_contas = TipoConta::all();
        $tipos_salas = Sala::all();

        if($request->isMethod('post')){

            $tipo_conta = $request->input('tipo_conta');

            $conta_imovel = new ContaImovel();
            $conta_imovel->valor = ProjectUtils::trocarVirgulaPorPonto($request->input('valor-conta'));
            $conta_imovel->ano = $request->input('ano');
            $conta_imovel->mes = $request->input('mes');
            $conta_imovel->dataVencimento = $request->input('data-vencimento');
            $conta_imovel->referenciaConta = ProjectUtils::tirarMascara($request->input('referencia'));
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
        
        return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas', 'conta_imovel', 'mensagem'));
    }

    public function regravarConta(Request $request, $idConta){

        
        try {
            $titulo = 'Edição de registro de contas';
            $tipos_contas = TipoConta::all();
            $tipos_salas = Sala::all();
            $conta_imovel = CalculoContasService::getContaBy($idConta);
            $mensagem = null; 

            if($request->isMethod('put')){
                $conta_imovel->valor = $request->input('valor-comprovante');
                $conta_imovel->dataVencimento = $request->input('data-vencimento');
                $conta_imovel->referenciaConta = $request->input('referencia');
                $conta_imovel->ano = $request->input('ano');
                $conta_imovel->mes = $request->input('mes');
                $conta_imovel->tipocodigo = $request->input('tipo-conta');
                $conta_imovel->salacodigo = $request->input('sala');

                if($request->input('tipo-conta') == '1'){
                    $conta_imovel->imovelcodigo = 1;
                }

                $conta_imovel->save();
                $mensagem = "sucesso";
            }

            return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas', 'conta_imovel', 'mensagem')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with("falha", "Não foi possível modificar esse registro");
        }
    }
}

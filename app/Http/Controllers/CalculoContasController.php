<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {

        $conta_imovel = null;
        $imoveis = ImoveisService::getListaImoveisSelect();

        $mensagem = null; 
        
        if($request->isMethod('post')){

            $tipo_conta = $request->input('tipo_conta');

            $conta_imovel = new ContaImovel();
            $conta_imovel->valor = ProjectUtils::trocarVirgulaPorPonto($request->input('valor-conta'));
            $conta_imovel->ano = $request->input('ano');
            $conta_imovel->mes = $request->input('mes');
            $conta_imovel->dataVencimento = ProjectUtils::inverterDataParaSalvar($request->input('data-vencimento'));
            $conta_imovel->referenciaConta = ProjectUtils::tirarMascara($request->input('referencia'));
            $conta_imovel->nrDocumento = $request->input('numero-documento');
            $conta_imovel->tipocodigo = $tipo_conta;

            if($tipo_conta === '2'){
                $conta_imovel->salacodigo = $request->input('sala');
            } else if($tipo_conta == '1') {
                $conta_imovel->salacodigo = 4;
            }

            $filePath = null; 

            if($request->hasFile('arquivo-conta')){
                $file = $request->file('arquivo-conta');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('contas-imovel', $fileName);
            }
            
            $conta_imovel->arquivo_conta = $filePath;

            $conta_imovel->save();
            $mensagem = 'sucesso';
        }

        $titulo = 'Calcular Contas';

        
        return view('app.calculo-contas', compact('titulo', 'conta_imovel', 'imoveis', 'mensagem'));
    }

    public function regravarConta(Request $request, $idConta){
        
        try {
            $titulo = 'Edição de registro de contas';
            $tipos_contas = TipoConta::all();
            $tipos_salas = Sala::all();
            $conta_imovel = CalculoContasService::getContaBy($idConta);
            $contas_inquilino_associadas = InquilinosService::getListaContasInquilinosByIdImovel($idConta);

            $mensagem = null; 

            $imoveis = ImoveisService::getImoveis();

            if($request->isMethod('put')){

                $tipo_conta = $request->input('tipo_conta');

                $conta_imovel->valor = ProjectUtils::trocarVirgulaPorPonto($request->input('valor-conta'));
                $conta_imovel->dataVencimento = ProjectUtils::inverterDataParaSalvar($request->input('data-vencimento'));
                $conta_imovel->referenciaConta = $request->input('referencia');
                $conta_imovel->ano = $request->input('ano');
                $conta_imovel->mes = $request->input('mes');
                $conta_imovel->tipocodigo = $tipo_conta;

                if($tipo_conta === '2'){
                    $conta_imovel->salacodigo = $request->input('sala');
                } else if($tipo_conta == '1') {
                    $conta_imovel->salacodigo = 4;
                }

                $filePath = null; 

                if($request->hasFile('arquivo-conta')){
                    $file = $request->file('arquivo-conta');
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('contas-imovel', $fileName);
                    $conta_imovel->arquivo_conta = $filePath;
                }
                
                $conta_imovel->save();
                $mensagem = "sucesso";
            }

            if($conta_imovel->dataVencimento != null){
                $conta_imovel->dataVencimento = ProjectUtils::inverterDataParaRenderizar($conta_imovel->dataVencimento);
            }

            return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas','imoveis', 'conta_imovel', 'mensagem', 'contas_inquilino_associadas')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with("falha", "Não foi possível modificar esse registro");
        }
    }


    public function deletarConta($id){
        $conta_deletada = ContaImovel::where('id', $id)->delete();
        return $conta_deletada;
    }
}

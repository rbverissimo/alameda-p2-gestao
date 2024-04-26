<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Imovel;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use App\Services\UsuarioService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {

        
        
        $usuario = UsuarioService::getUsuarioLogado();
        $idImoveisDoUsuario = UsuarioService::getImoveisBy($usuario);
        $imoveis = Imovel::whereIn('id', $idImoveisDoUsuario)->get();
        
        $tipos_contas = TipoConta::all();
        $tipos_salas = Sala::all();
        $mensagem = null; 
        
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
            } else if($tipo_conta == '1') {
                $conta_imovel->imovelcodigo = $request->input('imovelcodigo');
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
        
        return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas', 'imoveis', 'mensagem'));
    }

    public function regravarConta(Request $request, $idConta){
        
        try {
            $titulo = 'Edição de registro de contas';
            $tipos_contas = TipoConta::all();
            $tipos_salas = Sala::all();
            $conta_imovel = CalculoContasService::getContaBy($idConta);
            $mensagem = null; 

            $imoveis = Imovel::where('id', 1)->get();

            if($request->isMethod('put')){

                $tipo_conta = $request->input('tipo_conta');

                $conta_imovel->valor = $request->input('valor-conta');
                $conta_imovel->dataVencimento = $request->input('data-vencimento');
                $conta_imovel->referenciaConta = $request->input('referencia');
                $conta_imovel->ano = $request->input('ano');
                $conta_imovel->mes = $request->input('mes');
                $conta_imovel->tipocodigo = $tipo_conta;

                if($tipo_conta === '2'){
                    $conta_imovel->salacodigo = $request->input('sala');
                    $conta_imovel->imovelcodigo = null;
                } else if($tipo_conta == '1') {
                    $conta_imovel->imovelcodigo = $request->input('imovelcodigo');
                    $conta_imovel->salacodigo = null;
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

            return view('app.calculo-contas', compact('titulo', 'tipos_contas', 'tipos_salas','imoveis', 'conta_imovel', 'mensagem')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with("falha", "Não foi possível modificar esse registro");
        }
    }


    public function deletarConta($id){
        $conta_deletada = ContaImovel::where('id', $id)->delete();
        return $conta_deletada;
    }
}

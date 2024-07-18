<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Models\ContaImovel;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Utils\ProjectUtils;
use App\ValueObjects\MensagemVO;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {

        $conta_imovel = null;
        $imoveis = ImoveisService::getListaImoveisSelect();
        $imovel_conta_codigo = null;

        $mensagem = null; 
        
        if($request->isMethod('post')){

            $tipo_conta = $request->input('tipo-conta');

            $conta_imovel = new ContaImovel();
            $conta_imovel->valor = ProjectUtils::retirarMascaraMoeda($request->input('valor-conta'));
            $conta_imovel->ano = $request->input('ano');
            $conta_imovel->mes = $request->input('mes');
            $conta_imovel->dataVencimento = ProjectUtils::normalizarData($request->input('data-vencimento'), Operacao::SALVAR);
            $conta_imovel->referenciaConta = ProjectUtils::tirarMascara($request->input('referencia'));
            $conta_imovel->nrDocumento = $request->input('numero-documento');
            $conta_imovel->tipocodigo = $tipo_conta;
            $conta_imovel->salacodigo = $request->input('sala');


            $filePath = null; 

            if($request->hasFile('arquivo-conta')){
                $file = $request->file('arquivo-conta');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('contas-imovel', $fileName);
            }
            
            $conta_imovel->arquivo_conta = $filePath;

            $conta_imovel->save();
            $mensagem_vo = new MensagemVO('sucesso', 'O registra da conta do imóvel foi cadastrado com sucesso!');
            $mensagem = $mensagem_vo->getJson();
        }

        $titulo = 'Calcular Contas';

        $tipos_conta = null;
        $salas = null;

        return view('app.calculo-contas', compact('titulo', 'conta_imovel', 'imoveis', 'imovel_conta_codigo', 'tipos_conta', 'salas', 'mensagem'));
    }

    public function regravarConta(Request $request, $idConta){
        
        try {
            $titulo = 'Edição de registro de contas';
            $mensagem = null; 
            
            $conta_imovel = CalculoContasService::getContaBy($idConta);
            $sala_conta = $conta_imovel->salacodigo;
            $imovel_conta_codigo = $conta_imovel->getRelation('sala')->imovelcodigo;
            $contas_inquilino_associadas = InquilinosService::getListaContasInquilinosByIdImovel($idConta);

            
            
            $imoveis = ImoveisService::getListaImoveisSelect();
            $salas = ImoveisService::getSalaBy($imovel_conta_codigo);
            $tipos_conta = ImoveisService::getTipoContasBy($imovel_conta_codigo);

            if($request->isMethod('put')){

                
                $conta_imovel->valor = ProjectUtils::retirarMascaraMoeda($request->input('valor-conta'));
                $conta_imovel->dataVencimento = ProjectUtils::normalizarData($request->input('data-vencimento'), Operacao::SALVAR);
                $conta_imovel->referenciaConta = $request->input('referencia');
                $conta_imovel->ano = $request->input('ano');
                $conta_imovel->mes = $request->input('mes');
                $tipo_conta = $request->input('tipo-conta');
                $conta_imovel->tipocodigo = $tipo_conta;
                $conta_imovel->salacodigo = $request->input('sala');

                $filePath = null; 

                if($request->hasFile('arquivo-conta')){
                    $file = $request->file('arquivo-conta');
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('contas-imovel', $fileName);
                    $conta_imovel->arquivo_conta = $filePath;
                }

                $conta_imovel->save();

                $mensagem_vo = new MensagemVO('sucesso', 'O registra da conta do imóvel foi atualizado com sucesso!');

                if(!empty($contas_inquilino_associadas)){

                    $calculo = new CalculoContasService();
                    $calculo->atualizarCalculoContasInquilinos($sala_conta, $idConta);
                    $mensagem_vo = new MensagemVO('sucesso', 'O registra da conta do imóvel foi atualizado com sucesso e um novo cálculo de contas
                    da referência '.$conta_imovel->ano.'-'.$conta_imovel->mes.' foi realizado');
                    
                }


                $mensagem = $mensagem_vo->getJson();
                $contas_inquilino_associadas = InquilinosService::getListaContasInquilinosByIdImovel($idConta);
            }

            return view('app.calculo-contas', compact('titulo', 'tipos_conta', 'salas', 'imoveis', 
                'conta_imovel', 'mensagem', 'contas_inquilino_associadas', 'imovel_conta_codigo')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with("erros", $th->getMessage());
        }
    }


    public function deletarConta($id){
        $conta_deletada = ContaImovel::where('id', $id)->delete();
        return $conta_deletada;
    }
}

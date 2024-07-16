<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\TipoComprovante;
use App\Services\ComprovantesService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Utils\ProjectUtils;
use App\ValueObjects\MensagemVO;
use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{

    private $titulo = 'Comprovantes de Transferência';

    public function index(Request $request, $id = null){

        $mensagem = null; 
        $imoveis = ImoveisService::getListaImoveisSelect();

        if($request->isMethod('post')){
            
            $comprovante = new Comprovante();
            $comprovante->inquilino = $request->input('inquilino');
            $comprovante->valor = ProjectUtils::retirarMascaraMoeda($request->input('valor-comprovante'));
            $comprovante->dataComprovante = ProjectUtils::normalizarData($request->input('data-comprovante'), Operacao::SALVAR);
            $comprovante->referencia = ProjectUtils::tirarMascara($request->input('referencia'));
            $comprovante->descricao = $request->input('descricao');
            $comprovante->tipocomprovante = $request->input('tipo-comprovante');

            $filePath = null; 

            if($request->hasFile('arquivo-comprovante')){
                $file = $request->file('arquivo-comprovante');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('contas-imovel', $fileName);
                $comprovante->arquivo_comprovante = $filePath;
            }

            $comprovante->save();
            $mensagem_vo = new MensagemVO('sucesso', 'O comprovante foi inserido com sucesso!');
            $mensagem = $mensagem_vo->getJson();

        }

        $tipos_comprovantes = TipoComprovante::all();
        $inquilinos = [];
        

        return view('app.comprovantes-transferencia', 
            ['inquilinos'=>$inquilinos, 'titulo'=>$this->titulo, 'tipos_comprovantes'=>$tipos_comprovantes, 
            'mensagem'=>$mensagem, 'imoveis' => $imoveis]);
    }

    public function comprovantesPorInquilino($id){
        $comprovantes = Comprovante::where('inquilino', $id)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return $comprovantes;
    }

    public function comprovantesPor($paramName, $paramValue){
        $comprovantes = Comprovante::where($paramName, $paramValue)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return $comprovantes;
    }

    public function editarComprovante(Request $request, $id){
        try{
            $titulo = $this->titulo;
            $tipos_comprovantes = ComprovantesService::getTiposComprovantes();
            $comprovante = ComprovantesService::getComprovante($id);
            $imoveis = ImoveisService::getListaImoveisSelect();
            $inquilino = InquilinosService::getInquilinoBy($comprovante->inquilino);
            $inquilinos = InquilinosService::getInquilinosImovelUsingSala($inquilino->salacodigo);

            
            $mensagem = null; 
            
            if($request->isMethod('put')){
                $comprovante->valor = ProjectUtils::retirarMascaraMoeda($request->input('valor-comprovante'));
                $comprovante->dataComprovante = ProjectUtils::normalizarData($request->input('data-comprovante'), Operacao::SALVAR);
                $comprovante->referencia = ProjectUtils::tirarMascara($request->input('referencia'));
                $comprovante->descricao = $request->input('descricao');
                $comprovante->tipocomprovante = $request->input('tipo-comprovante');

                if($request->hasFile('arquivo-comprovante')){
                    $file = $request->file('arquivo-comprovante');
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('comprovantes-inquilinos', $fileName);
                    $comprovante->arquivo_comprovante = $filePath;
                }

                $comprovante->save();
                $mensagem_vo = new MensagemVO('sucesso', 'O comprovante foi atualizado com sucesso!');
                $mensagem = $mensagem_vo->getJson();
            }
            
            if($comprovante->dataComprovante != null){
                $dataNaoInvertida = $comprovante->dataComprovante;
                $comprovante->dataComprovante = ProjectUtils::inverterDataParaRenderizar($dataNaoInvertida);
            }
            

            return view('app.comprovantes-transferencia', compact('titulo', 'tipos_comprovantes', 'comprovante', 'imoveis', 'inquilinos', 'mensagem')); 
        } catch (\Exception $e) {
            return redirect()->back()->with("falha", "Não foi possível modificar esse registro");
        }
    }

    public function deletarComprovante($id){
        $comprovantes_deletados=Comprovante::where('id', $id)->delete();
        return $comprovantes_deletados;
        
    }
}

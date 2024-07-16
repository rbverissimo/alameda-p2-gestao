<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\TipoComprovante;
use App\Services\ComprovantesService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Utils\ProjectUtils;
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
            $comprovante->valor = ProjectUtils::trocarVirgulaPorPonto($request->input('valor-comprovante'));
            $comprovante->dataComprovante = ProjectUtils::inverterDataParaSalvar($request->input('data-comprovante'));
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
            $mensagem = "sucesso";

        }

        $tipos_comprovantes = TipoComprovante::all();
        $inquilinos_query = InquilinosService::getListaInputInquilinos();

        if($id != null){
            $inquilinos = array_filter($inquilinos_query, function ($inquilino) use ($id){
                return $inquilino->id === $id;
            });
        } else {

            $inquilino_vazio = new Inquilino();
            $inquilino_vazio->id = '';
            $inquilino_vazio->nome = '';

            $inquilinos = $inquilinos_query->prepend($inquilino_vazio);
        }
        

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

            
            $mensagem = null; 
            
            if($request->isMethod('put')){
                $comprovante->valor = ProjectUtils::trocarVirgulaPorPonto($request->input('valor-comprovante'));
                $comprovante->dataComprovante = ProjectUtils::inverterDataParaSalvar($request->input('data-comprovante'));
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
                $mensagem = "sucesso";
            }
            
            if($comprovante->dataComprovante != null){
                $dataNaoInvertida = $comprovante->dataComprovante;
                $comprovante->dataComprovante = ProjectUtils::inverterDataParaRenderizar($dataNaoInvertida);
            }
            

            return view('app.comprovantes-transferencia', compact('titulo', 'tipos_comprovantes', 'comprovante', 'mensagem')); 
        } catch (\Exception $e) {
            return redirect()->back()->with("falha", "Não foi possível modificar esse registro");
        }
    }

    public function deletarComprovante($id){
        $comprovantes_deletados=Comprovante::where('id', $id)->delete();
        return $comprovantes_deletados;
        
    }
}

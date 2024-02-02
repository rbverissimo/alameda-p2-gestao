<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\TipoComprovante;
use App\Services\ComprovantesService;
use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{

    private $titulo = 'Comprovantes de Transferência';

    public function index(Request $request, $id = null){

        $mensagem = null; 

        if($request->isMethod('post')){
            
            $comprovante = new Comprovante();
            $comprovante->inquilino = $request->input('inquilino');
            $comprovante->valor = $request->input('valor-comprovante');
            $comprovante->dataComprovante = $request->input('data-comprovante');
            $comprovante->referencia = $request->input('referencia');
            $comprovante->descricao = $request->input('descricao');
            $comprovante->tipocomprovante = $request->input('tipo-comprovante');


            $comprovante->save();
            $mensagem = "sucesso";

        }

        $tipos_comprovantes = TipoComprovante::all();

        $inquilinos_query = Inquilino::select('inquilinos.id', 'pessoas.nome')
                ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                ->where('inquilinos.situacao', '=', 'A');

        if($id != null){
            $inquilinos = $inquilinos_query->where('inquilinos.id', $id)->get();
        } else {
            $inquilinos = $inquilinos_query->get();
        }   
        

        return view('app.comprovantes-transferencia', 
            ['inquilinos'=>$inquilinos, 'titulo'=>$this->titulo, 'tipos_comprovantes'=>$tipos_comprovantes, 'mensagem'=>$mensagem]);
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
                $comprovante->valor = $request->input('valor-comprovante');
                $comprovante->dataComprovante = $request->input('data-comprovante');
                $comprovante->referencia = $request->input('referencia');
                $comprovante->descricao = $request->input('descricao');
                $comprovante->tipocomprovante = $request->input('tipo-comprovante');
                $comprovante->save();
                $mensagem = "sucesso";
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

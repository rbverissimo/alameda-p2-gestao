<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\TipoComprovante;
use App\Services\ComprovantesService;
use App\Services\InquilinosService;
use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{

    private $titulo = 'Comprovantes de Transferência';

    public function index(Request $request, $id = null){

        if($request->isMethod('post')){
            
            $comprovante = new Comprovante();
            $comprovante->inquilino = $request->input('inquilino');
            $comprovante->valor = $request->input('valor-comprovante');
            $comprovante->dataComprovante = $request->input('data-comprovante');
            $comprovante->referencia = $request->input('referencia');
            $comprovante->descricao = $request->input('descricao');
            $comprovante->tipocomprovante = $request->input('tipo-comprovante');


            $comprovante->save();

        }

        if($request->isMethod('put')){

            $id_comprovante = $request->input('id-comprovante');
            $comprovante = Comprovante::find($id_comprovante);
            $comprovante->valor = $request->input('valor-comprovante');
            $comprovante->dataComprovante = $request->input('data-comprovante');
            $comprovante->referencia = $request->input('referencia');
            $comprovante->descricao = $request->input('descricao');
            $comprovante->tipocomprovante = $request->input('tipo-comprovante');

            $comprovante->save();

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
            ['inquilinos'=>$inquilinos, 'titulo'=>$this->titulo, 'tipos_comprovantes'=>$tipos_comprovantes]);
    }

    public function comprovantesPorInquilino($id){
        $comprovantes = Comprovante::where('inquilino', $id)->paginate(15);
        return $comprovantes;
    }

    public function editarComprovante($id){

        $titulo = $this->titulo;
        $tipos_comprovantes = ComprovantesService::getTiposComprovantes();
        $comprovante = ComprovantesService::getComprovante($id);

        return view('app.comprovantes-transferencia', compact('titulo', 'tipos_comprovantes', 'comprovante'));
    }

    public function deletarComprovante($id){
        $comprovantes_deletados=Comprovante::where('id', $id)->delete();
        return $comprovantes_deletados;
        
    }
}

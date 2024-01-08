<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Inquilino;
use App\Models\TipoComprovante;
use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{

    private $titulo = 'Comprovantes de Transferência';

    public function index(Request $request){

        if($request->isMethod('post')){

            $comprovante = new Comprovante();
            $comprovante->inquilino = $request->input('inquilino');
            $comprovante->valor = $request->input('valor-comprovante');
            $comprovante->dataComprovante = $request->input('data-comprovante');
            $comprovante->referencia = $request->input('referencia');
            $comprovante->tipocomprovante = $request->input('tipo-comprovante');
            $comprovante->descricao = $request->input('descricao');

            $comprovante->save();

        }

        $tipos_comprovantes = TipoComprovante::all();

        $inquilinos = Inquilino::select('inquilinos.id', 'pessoas.nome')
            ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
            ->where('inquilinos.situacao', '=', 'A')
            ->get();

        return view('app.comprovantes-transferencia', 
            ['inquilinos'=>$inquilinos, 'titulo'=>$this->titulo, 'tipos_comprovantes'=>$tipos_comprovantes]);
    }

    public function comprovantesPorInquilino($id){
        //IMPLEMENTAR A PAGINAÇÃO AQUI
        $comprovantes = Comprovante::where('inquilino', $id)->get();
        return $comprovantes;
    }

    public function editarComprovante($id){
        $titulo = $this->titulo;
        return view('app.comprovantes-transferencia', compact('id', 'titulo'));
    }
}

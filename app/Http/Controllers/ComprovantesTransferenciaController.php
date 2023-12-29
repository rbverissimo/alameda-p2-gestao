<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Models\TipoComprovante;
use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{
    public function index(Request $request){

        if($request->isMethod('post')){

            
        }

        $titulo = 'Comprovantes de Transferência';
        $tipos_comprovantes = TipoComprovante::all();
        $inquilinos = Inquilino::select('pessoas.nome')
            ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
            ->where('inquilinos.situacao', '=', 'A')
            ->get();

        return view('app.comprovantes-transferencia', 
            ['inquilinos'=>$inquilinos, 'titulo'=>$titulo]);
    }
}

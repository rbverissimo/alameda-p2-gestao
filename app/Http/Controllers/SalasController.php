<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalasController extends Controller
{

    
    public function cadastrar(Request $request){

        $titulo = 'Cadastrar sala';

        try {
            return view('app.cadastro-sala', compact('titulo'));
        } catch (\Throwable $th) {
            
        }
    }
}

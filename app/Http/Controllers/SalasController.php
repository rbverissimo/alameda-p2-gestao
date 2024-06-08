<?php

namespace App\Http\Controllers;

use App\Services\ImoveisService;
use Illuminate\Http\Request;

class SalasController extends Controller
{

    
    public function cadastrar(Request $request, $idImovel){

        $titulo = 'Cadastrar sala';
        $imovel = ImoveisService::getImovelBy($idImovel);

        try {

            return view('app.cadastro-sala', compact('titulo', 'imovel'));

        } catch (\Throwable $th) {
            
        }
    }
    
}

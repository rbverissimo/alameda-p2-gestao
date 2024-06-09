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

    /**
     * Esse método é usado apenas para o cadastro de salas após o cadastro do imóvel.
     * Ele é do método 'cadastrar' do ImoveisController quando o cadastro de um imóvel é realizado
     * com sucesso. 
     * 
     */
    public function cadastrarPrimeiraSala(Request $request, $idImovel, $mensagem){
        $imovel = ImoveisService::getImovelBy($idImovel);
        $titulo = 'Cadastrar as salas do imóvel :'.$imovel->nomefantasia;

        try {
            return view('app.cadastro-sala', compact('titulo', 'idImovel', 'imovel', 'mensagem'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', $th->getMessage());
        }
        

    }

}

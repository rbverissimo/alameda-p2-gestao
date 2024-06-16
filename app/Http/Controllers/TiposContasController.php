<?php

namespace App\Http\Controllers;

use App\Models\TipoConta;
use App\Services\ImoveisService;
use Illuminate\Http\Request;

class TiposContasController extends Controller {


    public function cadastrarPrimeirasContas(Request $request, $idImovel){

        $titulo = 'Cadastro dos tipos de contas do imóvel';

        try {

            $imovel = ImoveisService::getImovelWithSalasBy($idImovel);

            if($imovel){
                $endereco = $imovel->endereco;
                $salas_cadastradas = [];

                if($endereco){
                    
                }

                if($imovel->sala){
                    foreach ($imovel->sala as $sala) {
                        
                    }
                }
            }

            $chips = TipoConta::all()->map(function($tipoConta){
                return [
                    'id' => 'chip-' + $tipoConta->id,
                    'text' => $tipoConta->descricao,
                    'value' => $tipoConta->id,
                ];
            }); 

            return view('app.cadastro-tipo-contas-imovel', compact('titulo', 'chips'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar os tipos de conta do imóvel. ' + $th->getMessage());
        }

    }

}
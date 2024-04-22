<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Illuminate\Http\Request;

class ImoveisController extends Controller
{

    public function index(){

        $titulo = 'Lista de Imóveis';

        $imoveis = Imovel::select('imoveis.id', 'imoveis.nomefantasia', 
            'enderecos.logradouro', 'enderecos.bairro', 'enderecos.numero', 'enderecos.cep', 'enderecos.cidade')
            ->join('enderecos', 'enderecos.id', 'imoveis.endereco')
            ->get();

        return view('app.imoveis', compact('titulo', 'imoveis'));
    }
    public function detalhar($imovel){

        $imovel_detalhado = Imovel::where('id', $imovel)->first();

        return 'Detalhar imóvel: '.$imovel_detalhado->nomefantasia; 
    }
}

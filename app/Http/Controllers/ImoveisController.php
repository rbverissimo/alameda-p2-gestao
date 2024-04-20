<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Illuminate\Http\Request;

class ImoveisController extends Controller
{

    public function index(){

        $titulo = 'Lista de Imóveis';

        $imoveis = Imovel::all();

        return view('app.imoveis', compact('titulo', 'imoveis'));
    }
    public function detalhar($imovel){

        $imovel_detalhado = Imovel::where('id', $imovel)->first();

        return 'Detalhar imóvel: '.$imovel_detalhado->nomefantasia; 
    }
}

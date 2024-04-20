<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    public function detalhar($imovel){

        $imovel_detalhado = Imovel::where('id', $imovel)->first();

        return 'Detalhar imóvel: '.$imovel_detalhado->nomefantasia; 
    }
}

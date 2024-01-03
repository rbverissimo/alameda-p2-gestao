<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use Illuminate\Http\Request;

class PainelInquilinoController extends Controller
{
    public function painel_inquilino($id){

        $inquilino = Inquilino::select('pessoas.nome', 'inquilinos.id')
        ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
        ->where('inquilinos.id', $id)
        ->first();

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;

        return view('app.painel-inquilino', compact('inquilino', 'titulo'));
    }
}

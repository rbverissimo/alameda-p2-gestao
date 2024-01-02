<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use Illuminate\Http\Request;

class ListaInquilinosController extends Controller
{
    public  function lista() {

        $titulo = 'Lista de Inquilinos';

        $inquilinos_ativos = Inquilino::select('inquilinos.id', 'inquilinos.valorAluguel',
        'pessoas.nome', 'pessoas.telefone_celular')
        ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
        ->where('inquilinos.situacao', '=', 'A')
        ->get();

        return view('app.listar-inquilinos', compact('titulo', 'inquilinos_ativos'));
    }
}

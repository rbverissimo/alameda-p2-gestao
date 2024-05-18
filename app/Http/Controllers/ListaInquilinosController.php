<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\UsuarioService;

class ListaInquilinosController extends Controller
{
    public  function lista() {

        $titulo = 'Lista de Inquilinos';
        $usuario = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($usuario);

        $inquilinos_ativos = Inquilino::select('inquilinos.id', 'inquilinos.valorAluguel',
        'pessoas.nome', 'pessoas.telefone_celular')
        ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
        ->join('salas', 'salas.id', 'inquilinos.salacodigo')
        ->whereIn('salas.imovelcodigo', $imoveis)
        ->where('inquilinos.situacao', '=', 'A')
        ->get();

        return view('app.listar-inquilinos', compact('titulo', 'inquilinos_ativos'));
    }
}

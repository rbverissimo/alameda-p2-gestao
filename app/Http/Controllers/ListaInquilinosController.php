<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\InquilinosService;
use App\Services\UsuarioService;

class ListaInquilinosController extends Controller
{
    public  function lista() {

        $titulo = 'Lista de Inquilinos';
        $usuario = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($usuario);

        $inquilinos_ativos = InquilinosService::getListaInquilinosAtivosTodosImoveis($imoveis);

        return view('app.listar-inquilinos', compact('titulo', 'inquilinos_ativos'));
    }
}

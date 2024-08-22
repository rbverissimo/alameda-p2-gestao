<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Services\UsuarioService;

class ListaInquilinosController extends Controller
{
    public function lista() {

        $titulo = 'Lista de Inquilinos';
        $id_imoveis = ImoveisService::getImoveisTodasImobiliarias();
        $inquilinos_ativos = InquilinosService::getListaInquilinosAtivosTodosImoveis($id_imoveis);
        $imoveis = ImoveisService::getListaImoveisSelect();

        return view('app.listar-inquilinos', compact('titulo', 'inquilinos_ativos', 'imoveis'));
    }
}

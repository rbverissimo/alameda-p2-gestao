<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(){
        $titulo = 'Painel de serviços tomados';
        try {
            return view('app.painel-servicos', compact('titulo'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível os serviços tomados '.$th->getMessage());
        }
    }

    public function cadastrar(Request $request){
        return 'Cadastrando servico';
    }
    public function editar(Request $request, $idServico){
        return 'Chegando até aqui no servico: ' + $idServico;
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\TiposServicosService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(){
        $titulo = 'Painel de serviços tomados';
        $mensagem = null;
        try {
            return view('app.painel-servicos', compact('titulo', 'mensagem'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível encontrar os serviços tomados '.$th->getMessage());
        }
    }

    public function cadastrar(Request $request){
        try {
            $titulo = 'Cadastrando serviço';
            $mensagem = null;
            $tipos_servicos = TiposServicosService::getListaTiposServicos();
            $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos', 'imobiliarias'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi cadastrar os serviços tomados '.$th->getMessage());
        }
    }
    public function editar(Request $request, $idServico){
        try {
            $titulo = 'Editando serviço '.$idServico;
            $mensagem = null;
            $tipos_servicos = TiposServicosService::getListaTiposServicos();

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi cadastrar os serviços tomados '.$th->getMessage());
        }
    }
}

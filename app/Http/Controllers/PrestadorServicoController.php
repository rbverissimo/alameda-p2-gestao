<?php

namespace App\Http\Controllers;

use App\Services\ImoveisService;
use App\ValueObjects\MensagemVO;
use Exception;
use Illuminate\Http\Request;

class PrestadorServicoController extends Controller
{

    public function index(){

        $titulo = 'Painel das informações dos prestadores de serviço';
        $mensagem = null;
        try {
            return view('app.painel-prestadores-servicos', compact('titulo', 'mensagem')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível acessar os prestadores de serviço '.$th->getMessage());
        }

    }

    public function cadastrarPrestador(Request $request){
        try {
            return view('app.cadastro-prestador-servico');
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar um prestador de serviço '.$th->getMessage());
        }
    }

    public function editarPrestador(Request $request, $idPrestador){
        $titulo = 'Editando o prestador';
        $mensagem = null;
        try {

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível encontrar o prestador de serviço selecionado '.$th->getMessage());
        }
    }

    public function buscarLista(){
       $imoveis = ImoveisService::getImoveisByUsuarioLogado();
       try {

       } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível buscar a lista de prestadores');
            $mensagem = $mensagem_vo->getJson();
            return redirect()->back()->with('erros', $th->getMessage())->with($mensagem);
       }
    }
}

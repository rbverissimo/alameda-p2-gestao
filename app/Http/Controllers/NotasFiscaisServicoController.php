<?php

namespace App\Http\Controllers;

use App\Models\BusinessObjects\NotasFiscaisServicosBO;
use App\Services\LogErrosService;
use App\Services\PrestadorServicoService;
use App\Services\TiposServicosService;
use App\ValueObjects\MensagemVO;
use Illuminate\Http\Request;

class NotasFiscaisServicoController extends Controller
{
    public function listarNotas($idPrestador){
        $nomePrestador = PrestadorServicoService::getNomePrestadorBy($idPrestador);
        $titulo = 'Cadastrando nota para o prestador '.$nomePrestador;
        $mensagem = null;
        try {
            return view('app.painel-notas-servicos', compact('titulo', 'mensagem', 'nomePrestador', 'idPrestador'));
        } catch (\Throwable $th) {

            LogErrosService::salvarErrosPassandoParametrosManuais(
                '/nfse/l/'.$idPrestador,
                $th->getMessage(),
                [
                    'idPrestador' => $idPrestador,
                    'nomePrestador' => $nomePrestador
                ],
                'GET'
                
            );

            return redirect()->back()->with('erros', 'Não foi possível encontrar as notas do prestador de serviços selecionado. ');
        }

    }

    public function cadastrarNota(Request $request, $idPrestador){
        $titulo = 'Cadastro de NFS-e';
        $mensagem = null;
        $tipos_servicos = TiposServicosService::getListaTiposServicos();
        
        try {
            $nota = null;

            if($request->isMethod('POST')){
                
                dd($request);
                
            }

            return view('app.cadastro-nota-servico', compact('titulo', 'mensagem', 'idPrestador', 'nota', 'tipos_servicos'));
        } catch (\Throwable $th) {
            //throw $th;
        }   
    }

    public function editarNota(Request $request, $id){

    }

    public function deletar(Request $request){
        try {
            $bo = new NotasFiscaisServicosBO();
            $deletado = $bo->deletarNota($request->query('id'));
            return response()->json(['deletado' => $deletado], 200);
        } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível deletar a nota fiscal selecionada.'.$th->getMessage());
            $mensagem = $mensagem_vo->getJson();
            return response()->json($mensagem, 500);
        }
    }

}

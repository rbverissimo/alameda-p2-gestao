<?php

namespace App\Http\Controllers;

use App\Http\Dto\RequestParamsDTO;
use App\Models\BusinessObjects\LogErrosBO;
use App\Models\BusinessObjects\NotasFiscaisServicosBO;
use App\Models\BusinessObjects\PrestadorServicoBO;
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
        
        $prestador_servico_bo = new PrestadorServicoBO();

        $servicos_prestados = array_map(function($servico){
            return [
                'nome' => $servico['ud_nome'],
                'codigo' => $servico['ud_codigo']
            ];
        }, $prestador_servico_bo->getServicosPrestados($idPrestador)->toArray());
        
        try {
            $nota = null;

            if($request->isMethod('POST')){
                
                
                
            }

            return view('app.cadastro-nota-servico', compact('titulo', 'mensagem', 'idPrestador', 'nota', 'tipos_servicos', 'servicos_prestados'));
        } catch (\Throwable $th) {
            LogErrosBO::salvarErros(new RequestParamsDTO($request), $th);
            return redirect()->back()->with('erros', 'Não foi possível cadastrar a nota informada para o prestador de serviço');
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

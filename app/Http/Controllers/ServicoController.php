<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Http\Dto\RequestParamsDTO;
use App\Http\Dto\ServicoDTO;
use App\Http\Dto\ServicoDTOBuilder;
use App\Models\BusinessObjects\LogErrosBO;
use App\Services\ImobiliariasService;
use App\Services\TiposServicosService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            if($request->isMethod('POST')){

                
                $codigoServico = $request->input('codigo-servico');
                $nomeServico = $request->input('nome-servico');
                $sala = $request->input('sala-select');
                $dataInicio = ProjectUtils::normalizarData($request->input('data-inicio'), Operacao::SALVAR);
                $dataFim = ProjectUtils::normalizarData($request->input('data-fim'), Operacao::SALVAR);
                $valorServico = ProjectUtils::retirarMascaraMoeda($request->input('valor-servico'));
                $tipoServico = $request->input('tipo-servico');
                $descricaoServico = $request->input('descricao-servico');

                // idetificador => nome_prestador
                $prestadores = CollectionUtils::getAssociativeArray($request->input(), '-', 1, 'prestador');


                $servico_dto = (new ServicoDTOBuilder)
                    ->withCodigo($codigoServico)
                    ->withNome($nomeServico)
                    ->withSala($sala)
                    ->withDataInicio($dataInicio)
                    ->withDataFim($dataFim)
                    ->withValor($valorServico)
                    ->withTipo($tipoServico)
                    ->withDescricao($descricaoServico)
                    ->withPrestadores($prestadores)
                    ->build();

                DB::transaction(function () use ($servico_dto){
                    
                });    


            }

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos', 'imobiliarias'));
        } catch (\Throwable $th) {

            $request_params = new RequestParamsDTO($request);
            $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
            $log_erros_bo->salvar();

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

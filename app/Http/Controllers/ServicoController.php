<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Http\Dto\RequestParamsDTO;
use App\Http\Dto\ServicoDTO;
use App\Http\Dto\ServicoDTOBuilder;
use App\Models\BusinessObjects\LogErrosBO;
use App\Models\BusinessObjects\ServicosTomadosBO;
use App\Models\Servico;
use App\Services\ImobiliariasService;
use App\Services\LogErrosService;
use App\Services\PrestadorServicoService;
use App\Services\ServicosTomadosService;
use App\Services\TiposServicosService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use App\ValueObjects\ListaServicoTomadoItemVO;
use App\ValueObjects\MensagemVO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    public function index(){
        $titulo = 'Painel de serviços tomados';
        $mensagem = null;
        try {

            $bo = new ServicosTomadosBO();
            $dados = $bo->getPainelServicosLista();

            $servicos = array_map(function($dado) {
                return new ListaServicoTomadoItemVO($dado->id, $dado->ud_nome, $dado->valor);
            }, $dados);

            return view('app.painel-servicos', compact('titulo', 'mensagem', 'servicos'));
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

                $bo = new ServicosTomadosBO();
                $regras = $bo->getRegrasValidacao();

                $request->validate($regras);

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


                    Servico::create([
                        'ud_codigo' => $servico_dto->getCodigo(),
                        'ud_nome' => $servico_dto->getNome(),
                        'salacodigo' => $servico_dto->getSala(),
                        'dataInicio' => $servico_dto->getDataInicio(),
                        'dataFim' => $servico_dto->getDataFim(),
                        'valor' => $servico_dto->getValor(),
                        'tipo_servico' => $servico_dto->getTipo(),
                        'descricao' => $servico_dto->getDescricao()
                    ]);

                    $servico_id = DB::getPdo()->lastInsertId();
                    $sql = 'INSERT INTO PRESTADORES_SERVICOS_PRESTADOS (idPrestador, idServico, created_at, updated_at) VALUES(?, ?, ?, ?)';

                    foreach ($servico_dto->getPrestadores() as $identificador => $nomePrestador) {
                        $idPrestador = PrestadorServicoService::getIdPrestadorBy($nomePrestador);
                        $timestamp = Carbon::now()->toDateTimeString();
                        $bindings = [$idPrestador, $servico_id, $timestamp, $timestamp];
                        DB::insert($sql, $bindings);
                    }

                });    
                
                $mensagem_vo = new MensagemVO('sucesso', 'Serviço cadastrado com sucesso!');
                $mensagem = $mensagem_vo->getJson();   

            }

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos', 'imobiliarias'));
        } catch (\Throwable $th) {

            $request_params = new RequestParamsDTO($request);
            $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
            $log_erros_bo->salvar();

            return redirect()->back()->with('erros', 'Não foi cadastrar os serviços tomados '.$th->getMessage());
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

    public function checarCodigoNome($param){

        try {
            $isCodigo = ProjectUtils::isStringNumerica($param);
            $encontrado = $isCodigo ? ServicosTomadosService::existsBy('ud_codigo', $param) : ServicosTomadosService::existsBy('ud_nome', $param);
            return response('Sucesso na requisição', 200)->json(['parametroPermitido' => !$encontrado]);

        } catch (\Throwable $th) {

            $json_array = [
                'isCodigo' => $isCodigo,
                'param' => $param,
            ];
            LogErrosService::salvarErrosPassandoParametrosManuais(
                './servicos/c/cn/'.$param,
                $th->getMessage(),
                json_encode($json_array),
                'GET'
            );

            return response('Falha na requisição', 500);
        }
    }
}

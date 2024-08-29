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
use App\Services\ImoveisService;
use App\Services\LogErrosService;
use App\Services\PrestadorServicoService;
use App\Services\ServicosTomadosService;
use App\Services\TiposServicosService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use App\ValueObjects\CadastroServicoVO;
use App\ValueObjects\ListaServicoTomadoItemVO;
use App\ValueObjects\MensagemVO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

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
            redirect()->back()->with('erros', 'Não foi possível encontrar os serviços tomados ');
        }
    }

    public function cadastrar(Request $request){
        try {
            $titulo = 'Cadastrando serviço';
            $mensagem = null;
            $tipos_servicos = TiposServicosService::getListaTiposServicos();
            $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();
            $servico = null;

            if($request->isMethod('POST')){

                $bo = new ServicosTomadosBO();
                $regras = $bo->getRegrasValidacao();

                $validator = Validator::make($request->input(), $regras, $bo->getMensagensValidacao());
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->with('erros', 'Informações inválidas');
                }

                $codigoServico = $request->input('codigo-servico');
                $nomeServico = $request->input('nome-servico');
                $sala = $request->input('sala-select');
                $dataInicio = ProjectUtils::normalizarData($request->input('data-inicio'), Operacao::SALVAR);
                $dataFim = ProjectUtils::normalizarData($request->input('data-fim'), Operacao::SALVAR);
                $valorServico = ProjectUtils::retirarMascaraMoeda($request->input('valor-servico'));
                $tipoServico = $request->input('tipo-servico');
                $descricaoServico = $request->input('descricao-servico');

                
                // idetificador => nome_prestador
                $prestadores = CollectionUtils::getAssociativeArray($request->input(), '-', 2, 'prestador-servico');


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

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos', 'imobiliarias', 'servico'));
        } catch (\Throwable $th) {

            $request_params = new RequestParamsDTO($request);
            $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
            $log_erros_bo->salvar();

            return redirect()->back()->with('erros', 'Não foi cadastrar os serviços tomados ');
        }
    }
    public function editar(Request $request, $idServico){
        try {
            $titulo = 'Editando serviço '.$idServico;
            $mensagem = null;
            $tipos_servicos = TiposServicosService::getListaTiposServicos();
            $model = ServicosTomadosService::getServicosBy($idServico);
            $servico = CadastroServicoVO::buildVO($model);
            $imobiliarias = $servico->getImobiliariasSelect();

            if($request->isMethod('PUT')){
                $bo = new ServicosTomadosBO();

                $servico_dto = $bo->getDto($request->input(), $idServico);


                DB::transaction(function () use ($servico_dto, $idServico, $bo){
                    $servico_old = $bo->getServicoBy($idServico);

                    $servico_old->ud_codigo = $servico_dto->getCodigo();
                    $servico_old->ud_nome = $servico_dto->getNome();
                    $servico_old->descricao = $servico_dto->getDescricao();
                    $servico_old->dataFim = $servico_dto->getDataFim();
                    $servico_old->dataInicio = $servico_dto->getDataInicio();
                    $servico_old->valor = $servico_dto->getValor();
                    $servico_old->salacodigo = $servico_dto->getSala();
                    $servico_old->tipo_servico = $servico_dto->getTipo();

                    $sql = 'INSERT INTO PRESTADORES_SERVICOS_PRESTADOS (idPrestador, idServico, created_at, updated_at) VALUES(?, ?, ?, ?)';

                    foreach ($servico_dto->getPrestadores() as $nomePrestador) {
                        $idPrestador = PrestadorServicoService::getIdPrestadorBy($nomePrestador);
                        $timestamp = Carbon::now()->toDateTimeString();
                        $bindings = [$idPrestador, $servico_old->id, $timestamp, $timestamp];
                        DB::insert($sql, $bindings);
                    }

                    $sql = 'DELETE FROM PRESTADORES_SERVICOS_PRESTADOS WHERE IDPRESTADOR = ? AND IDSERVICO = ?';

                    foreach ($servico_dto->getPrestadoresExcluir() as $nomePrestador) {
                        $idPrestador = PrestadorServicoService::getIdPrestadorBy($nomePrestador);
                        $bindings = [$idPrestador, $servico_old->id];
                        DB::delete($sql, $bindings);
                    }
                    $servico_old->save();
                });

                $mensagem_vo = new MensagemVO('sucesso', 'O serviço foi atualizado com sucesso!');
                $mensagem = $mensagem_vo->getJson();

                $newModel = $bo->getServicoBy($idServico);
                $servico = CadastroServicoVO::buildVO($newModel);
            }

            return view('app.cadastro-servico', compact('titulo', 'mensagem', 'tipos_servicos', 'imobiliarias', 'servico'));
        } catch (\Throwable $th) {

            $request_params = new RequestParamsDTO($request);
            $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
            $log_erros_bo->salvar();

            if($th instanceof ValidationException){
                return redirect()->back()->with('erros', 'O formulário está inválido. ');
            }
            
            return redirect()->back()->with('erros', 'Não foi cadastrar os serviços tomados ');

        }
    }

    public function deletar(Request $request){
        $idServico = $request->query('id');
        try {

            $bo = new ServicosTomadosBO();
            $deletado = $bo->deletarServico($idServico);

            return response()->json(['deletado' => $deletado], 200);
        } catch (\Throwable $th) {

            $mensagem_vo = new MensagemVO('falha', $th->getMessage());
            $mensagem = $mensagem_vo->getJson();

            return response()->json($mensagem, 500);
        }
    }

    /**
     * O intuito deste método é retornar ao front-end uma checagem se o código ou nome
     * definido pelo usuário para o serviço são válidos e podem ser usados
     */
    public function checarCodigoNome(Request $request){

        try {
            $param = $request->query('param');

            $isCodigo = ProjectUtils::isStringNumerica($param);
            $encontrado = $isCodigo ? ServicosTomadosService::existsBy('ud_codigo', $param) : ServicosTomadosService::existsBy('ud_nome', $param);
            return response()->json(['parametroPermitido' => !$encontrado]);

        } catch (\Throwable $th) {

            $json_array = [
                'isCodigo' => $isCodigo,
                'param' => $param,
            ];
            LogErrosService::salvarErrosPassandoParametrosManuais(
                '/servicos/c/cn/permit'.$param,
                $th->getMessage(),
                json_encode($json_array),
                'GET'
            );

            return response('Falha na requisição', 500);
        }
    }
}

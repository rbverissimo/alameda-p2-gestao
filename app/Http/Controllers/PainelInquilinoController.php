<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Http\Dto\LogErroDTO;
use App\Http\Dto\RequestParamsDTO;
use App\Http\Dto\TelefoneDTOBuilder;
use App\Models\BusinessObjects\InquilinoBO;
use App\Models\BusinessObjects\LogErrosBO;
use App\Models\Contrato;
use App\Models\Inquilino;
use App\Models\InquilinoAluguel;
use App\Models\InquilinoFatorDivisor;
use App\Models\InquilinoSaldo;
use App\Models\Telefone;
use App\Services\ComprovantesService;
use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Services\LogErrosService;
use App\Services\SituacaoFinanceiraService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use App\ValueObjects\AppDataVO;
use App\ValueObjects\MensagemVO;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

class PainelInquilinoController extends Controller
{
    private $titulo = 'Painel do Inquilino: '; 

    public function lista() {

        $titulo = 'Lista de Inquilinos';
        $id_imoveis = ImoveisService::getImoveisTodasImobiliarias();
        $inquilinos_ativos = InquilinosService::getListaInquilinosAtivosTodosImoveis($id_imoveis);
        $imoveis = ImoveisService::getListaImoveisSelect();

        return view('app.listar-inquilinos', compact('titulo', 'inquilinos_ativos', 'imoveis'));
    }

    public function filtrarLista(Request $request){
        try {

            $filtros = [
            'nome' => $request->query('nome'),
            'situacao' => $request->query('situacao'),
            'imovel' => $request->query('imovel') 
            ];

            $whereClause = [];
            foreach ($filtros as $key => $value) {
                if(!($value === '' || $value === null || $value === 'null')){
                    switch($key){
                        case 'imovel':
                            $whereClause[] = ['salas.imovelcodigo', $value];
                        break;
                        case 'nome':
                            $whereClause[] = ['inquilinos.nome', 'like', $value.'%'];
                        break;
                        case 'situacao':
                            $whereClause[] = ['inquilinos.situacao', $value];
                        default:
                    }
                }
            }

            $inquilinos = InquilinosService::getListaInquilinosFiltros($whereClause);

            return response()->json(["inquilinos" => $inquilinos->toArray(), "filtros" => $filtros, "whereClause" => $whereClause]);
        } catch (\Throwable $th) {
            return response('Não foi possível filtrar os inquilinos. Erros: '.$th->getMessage(), 500);
        }
    }

    public function painel_inquilino($id){

        $inquilino = InquilinosService::getInfoPainelInquilino($id);

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;
        $situacao_financeira_service = new SituacaoFinanceiraService();
        $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, ProjectUtils::getAnoMesSistemaSemMascara());
        
        if(!empty($situacao_financeira->contas_inquilino)){
            $situacao_financeira->contas_inquilino = $situacao_financeira_service->getContasDivididasEmRows($situacao_financeira->contas_inquilino);
        }

        $mensagem = null;

        $appData_vo = new AppDataVO('dados_inquilino', [
            'inquilino_id' => $inquilino->id,
            'nome_inquilino' => $inquilino->nome
        ]);

        $appData = $appData_vo->getJson();

        return view('app.painel-inquilino', compact('inquilino', 'titulo', 'situacao_financeira', 'mensagem', 'appData'));
    }

    /**
     * Esse é o método que busca as informações do inquilino para a edição
     */
    public function detalharInquilino($id, $mensagem = null){

        $detalhes = InquilinoBO::getDetalhesInquilino($id);
        $inquilino = $detalhes['inquilino'];
        $imoveis = $detalhes['imoveis'];
        $salas = $detalhes['salas'];
        $contrato = $detalhes['contrato'];
        $imobiliarias = $detalhes['imobiliarias'];

        $titulo = 'Detalhes do Inquilino: '.$inquilino->nome; 
        $appData_vo = new AppDataVO('detalhes_inquilino', [
            'nome_inquilino' => $inquilino->nome,
            'id_inquilino' => $inquilino->id
        ]);
        $appData = $appData_vo->getJson();
        return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'imobiliarias', 'imoveis', 'salas', 'contrato', 'mensagem', 'appData'));

    }

    public function toggleSituacaoAtividadeInquilino($id){
        $inquilino = Inquilino::find($id);

        if (!$inquilino) {
            return response()->json(['message' => 'Inquilino '.$id.' não encontrado'], 404);
        }
        
        try {
            if($inquilino->situacao == 'A'){
                $inquilino->situacao = 'I';
            } else {
                $inquilino->situacao = 'A';
            }
        
            $inquilino->save();
        
            return response()->json(['mensagem' => 'Situação do inquilino alterada com sucesso!', 'inquilino' => $inquilino]);
        } catch (\Exception $e) {
            return response()->json(['mensagem' => 'Erro alterar a situação do inquilino: ', 'error' => $e->getMessage()], 500);
        }
    }


    public function cadastrarInquilino(Request $request){

        try {

            $titulo = 'Cadastro de Inquilinos';
            $mensagem = null;
            $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();
            $imoveis = [];
            $salas = !empty($imoveis) ? ImoveisService::getSalaBy($imoveis[0]->id) : [];
            $contrato = null;
            
            if($request->isMethod('POST')){

                $telefones = CollectionUtils::getAssociativeArray($request->all(), '-', 3, 'd-i-telefone-'); //d-i- dynamic-input
                $tipos_telefones = CollectionUtils::getAssociativeArray($request->all(), '-', 2, 'telefone-select-');
                $telefones_data = CollectionUtils::mergirArraysByChaves($telefones, $tipos_telefones, 'telefone', 'tipo');
                $telefones_dto = (new TelefoneDTOBuilder())->getDto($telefones_data);

                $regras_feedback = InquilinoBO::getRegrasValidacao();
                $request->validate($regras_feedback['regras'], $regras_feedback['feedback']);
                
                DB::transaction(function($closure) use ($request, $telefones_dto){

                    $inquilino = Inquilino::create([
                        "nome" => $request->input('nome'),
                        "cpf" => ProjectUtils::tirarMascara($request->input('cpf')),
                        "profissao" => $request->input('profissao'),
                        'salacodigo' => $request->input('sala')
                    ]);
                    
                    $inicioValidade_aluguel = ProjectUtils::getReferenciaFromDate(ProjectUtils::normalizarData($request->input('data-assinatura'), Operacao::NORMALIZAR));
                    $fimValidade_aluguel = $request->input('data-expiracao') !== null ?
                        ProjectUtils::getReferenciaFromDate(ProjectUtils::normalizarData($request->input('data-expiracao'), Operacao::NORMALIZAR)) : null;
                    
                    $inquilino_id_inserido = DB::getPdo()->lastInsertId(); // snapshot desse momento    

                    foreach ($telefones_dto as $dto) {
                        Telefone::create([
                            'ddd' => $dto->getDdd(),
                            'telefone' => $dto->getTelefone(),
                            'tipo_telefone' => $dto->getTipo()
                        ]);
                    }

                    $inquilino_aluguel = InquilinoAluguel::create([
                        'inquilino' => $inquilino_id_inserido, 
                        'valorAluguel' => ProjectUtils::retirarMascaraMoeda($request->input('valor-aluguel')),
                        'inicioValidade' => $inicioValidade_aluguel,
                        'fimValidade' => $fimValidade_aluguel
                    ]);

                    $inquilino_fator_divisor = InquilinoFatorDivisor::create([
                        'inquilino_id' => $inquilino_id_inserido,
                        'fatorDivisor' => $request->input('fator-divisor') !== null ? $request->input('fator-divisor') : 1.0
                    ]);
    
                    $renovacao_automatica = $request->input('renovacao-automatica') === 'on' ? 'S' : 'N'; 
    
                    $contratoPath = null;
    
                    if($request->hasFile('contrato')){
                        $file = $request->file('contrato');
                        $fileName = $file->getClientOriginalName();
                        $contratoPath = $file->storeAs('contratos', $fileName);
                    }
                    $contrato = Contrato::create([
                        'aluguel' => DB::getPdo()->lastInsertId(),
                        'dataAssinatura' => ProjectUtils::normalizarData($request->input('data-assinatura'), Operacao::SALVAR),
                        'dataExpiracao' => $request->input('data-expiracao') ? ProjectUtils::normalizarData($request->input('data-expiracao'), Operacao::SALVAR) : null,
                        'renovacaoAutomatica' => $renovacao_automatica,
                        'contrato' => $contratoPath
                    ]);
                });


                $mensagem_vo = new MensagemVO('sucesso', 'O Inquilino '.$request->input('nome').' foi cadastrado com sucesso!');
                $mensagem = $mensagem_vo->getJson();

            }

            return view('app.cadastro-inquilino', compact('titulo', 'imobiliarias', 'imoveis', 'salas', 'mensagem', 'contrato'));
        } catch (\Throwable $th) {

            $request_params = new RequestParamsDTO($request);
            $log_erros_bo = new LogErrosBO($request_params, $th->getMessage());
            $log_erros_bo->salvar();

            if($th instanceof ValidationException){
                return back()->withErrors($th->validator->errors())->withInput($request->all());
            }
            return redirect()->back()->with("erros", "Não foi possível cadastrar um inquilino. Erro: ".$th->getMessage());
        }

    }

    public function editarInquilino(Request $request, $id){
        try {

            $titulo = $this->titulo;
            $inquilino = InquilinosService::getInquilinoCompletoBy($id);
            $mensagem = '';
            
            $regras_feedback = InquilinoBO::getRegrasValidacao();
            $request->validate($regras_feedback['regras'], $regras_feedback['feedback']);

            DB::transaction(function($closure) use($request, $inquilino){

                $aluguel = $inquilino->getRelation('aluguel')[0];
                $contrato = null;
                if($aluguel->contrato !== null){
                    $contratoPath = null;
    
                    $contrato = $aluguel->contrato;

                    if($request->hasFile('contrato')){
                        $file = $request->file('contrato');
                        $fileName = $file->getClientOriginalName();
                        $contratoPath = $file->storeAs('contratos', $fileName);
                    }

                    $contrato->contrato = $contratoPath;

                    if($contratoPath !== null){
                        $contrato->dataAssinatura = ProjectUtils::normalizarData($request->input('data-assinatura'), Operacao::SALVAR);
    
                        $dataExpiracao = $request->input('data-expiracao');
                        if($dataExpiracao !== null){
                            $contrato->dataExpiracao = ProjectUtils::normalizarData($dataExpiracao, Operacao::SALVAR);
                        }

                        $renovacao_automatica = $request->input('renovacao-automatica') === 'on' ? 'S' : 'N'; 

                        $contrato->renovacaoAutomatica = $renovacao_automatica;

                    }

                    $contrato->save();

                }
                

                $fator_divisor = $inquilino->getRelation('fator_divisor');
                $fator_divisor->fatorDivisor = $request->input('fator-divisor');
                $fator_divisor->save();

                $aluguel->valorAluguel = ProjectUtils::retirarMascaraMoeda($request->input('valor-aluguel'));

                $aluguel->save();


                $inquilino->nome = $request->input('nome');
                $inquilino->cpf = ProjectUtils::tirarMascara($request->input('cpf'));
                $inquilino->profissao = $request->input('profissao');
                $inquilino->salacodigo = $request->input('sala');

                $inquilino->save();


            });

            $mensagem_vo = new MensagemVO('sucesso', 'Os dados do(a) inquilino(a) '.$request->input('nome').' foram atualizados com sucesso!');
            $mensagem = $mensagem_vo->getJson();

            return $this->detalharInquilino($id, $mensagem);

        } catch (\Exception $e) {
            if($e instanceof ValidationException){
                back()->withErrors($e->validator->errors())->withInput($request->all());
            }
            return redirect()->back()->with('erros', $e->getMessage());
        }        
    }

    public function mostrarSituacaoFinanceira(Request $request, $idInquilino, $referencia = null){

        try {
            $inquilino = InquilinosService::getDetalhesInquilino($idInquilino);
            $referencia_situacao_financeira = $referencia ? $referencia : (int) ProjectUtils::getAnoMesSistemaSemMascara();
    
            if (!is_numeric($referencia_situacao_financeira)) {
                throw new InvalidArgumentException('A referência da situação financeira deve ser uma representação válida de ano e mês como 
                    202404, representando o ano de 2024 e o mês de abril (04)');
            }
            
            $titulo = 'Situacao Financeira do Inquilino: '.$inquilino->nome;
    
            $itens_carrossel = [$referencia_situacao_financeira];

            $situacao_financeira_service = new SituacaoFinanceiraService();
            $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, $referencia_situacao_financeira);
            $comprovantes = ComprovantesService::getComprovantesBy($inquilino->id, $referencia_situacao_financeira);
            $contas_referencia = InquilinosService::getContasInquilinoBy($idInquilino, $referencia_situacao_financeira);

            $appData_vo = new AppDataVO('painel_situacao_financeira', [
                'inquilino_id' => $idInquilino,
                'referencia' => $referencia_situacao_financeira
            ]);

            $appData = $appData_vo->getJson();
    
            return view('app.painel-situacao-financeira', compact('titulo', 'itens_carrossel', 'inquilino', 
                'situacao_financeira', 'appData', 'comprovantes', 'contas_referencia'));
        } catch (\InvalidArgumentException | Exception $e) {
            return redirect()->back()->with('erros', $e->getMessage());   
        }

    }

    public function consolidarSaldo($idInquilino){

        try {
            $mensagem_estado = "O saldo foi consolidado, porém sem alteração nos registros de saldos";
            $soma_todas_contas = InquilinosService::getTodasContasRegistradas($idInquilino);
            $soma_todos_comprovantes = InquilinosService::getSomaDeTodosOsComprovantesRegistrados($idInquilino);

            $soma_todos_alugueis = InquilinosService::getSomaTodosAlugueis($idInquilino);

            $creditos_json = $soma_todos_comprovantes['comprovantes'];
            $debitos_json = ProjectUtils::mergeJson($soma_todos_alugueis['alugueis'], $soma_todas_contas['contas']);

            $saldo_atual = $soma_todos_comprovantes['soma'] - ($soma_todas_contas['soma'] + $soma_todos_alugueis['soma']);

            $saldo_atual_ja_consolidado = 0.0;
            $saldo_atual_anterior = InquilinosService::getSaldoAtualBy($idInquilino);
            if($saldo_atual_anterior !== null){
                $saldo_atual_ja_consolidado = $saldo_atual_anterior->saldo_atual;
            }

            if($saldo_atual !== $saldo_atual_ja_consolidado){


                InquilinoSaldo::create(
                    [
                        'inquilinocodigo' => $idInquilino,
                        'saldo_atual' => $saldo_atual,
                        'saldo_anterior' => $saldo_atual_ja_consolidado,
                        'creditos_json' => $creditos_json,
                        'debitos_json' => $debitos_json
                    ]
                );

                $mensagem_estado = "O saldo foi consolidado com a criação de um novo registro de saldos";

            }

            $mensagem_vo = new MensagemVO('sucesso', $mensagem_estado);
            $mensagem = $mensagem_vo->getJson();

            $data_atualizacao = InquilinosService::getSaldoAtualBy($idInquilino)->updated_at;
            $data_atualizacao = date('d-M-Y H:i', strtotime($data_atualizacao));

            
            return response()->json(['saldo_atual' => $saldo_atual, 'data_atualizacao' => $data_atualizacao,  'mensagem' => $mensagem]);
        } catch (\Throwable $th) {

            $mensagem_estado = 'Um erro aconteceu na consolidação do saldo. Entre em contato com o suporte. ';
            $mensagem_vo = new MensagemVO('falha', $mensagem_estado);
            $mensagem = $mensagem_vo->getJson();

            $json = ProjectUtils::mergeJson($creditos_json, $debitos_json);
            LogErrosService::salvarErrosPassandoParametrosManuais(
                './consolidar/s/'.$idInquilino,
                $th->getMessage(),
                $json,
                'GET'
            );

            return response()->json(['mensagem' => $mensagem]);
        }


        
    }

    public function editarContaInquilino(Request $request, $idConta){
        try {

            $titulo = 'Editar conta '.$idConta.' do inquilino';
            $mensagem = null; 
            $conta = InquilinosService::getInquilinoContaById($idConta);
            $contas_imovel = ImoveisService::getContasImovelById($conta->contacodigo);

            if($request->isMethod('PUT')){

                $mensagem_exception = "O valor da conta do inquilino está inválido pois 
                (a soma de todas as contas de inquilino para essa conta de imóvel) é inferior ao valor da conta do imóvel";

                $valor_conta_imovel = ImoveisService::getContaImovelValorById($conta->contacodigo);
                $soma_outras_contas_inquilinos = ImoveisService::getSomaContasInquilinoByContaImovelExceto($conta->contacodigo, $idConta);

                $valorinquilino = floatval(ProjectUtils::retirarMascaraMoeda($request->input('valor-inquilino')));

                if($valorinquilino + $soma_outras_contas_inquilinos < $valor_conta_imovel){
                    throw new InvalidArgumentException($mensagem_exception);
                }

                if($valorinquilino < $conta->valorinquilino){
                    $limite = $valor_conta_imovel - $soma_outras_contas_inquilinos;
                    if($valorinquilino < $limite){
                        throw new InvalidArgumentException($mensagem_exception);
                    }
                }

                $data_pagamento = $request->input('data-pagamento') !== null ?
                     ProjectUtils::normalizarData($request->input('data-pagamento'), Operacao::SALVAR)
                     : null;
                     
                $quitada = $request->input('quitada') === 'on' ? 'S' : 'N';

                $conta->valorinquilino = $valorinquilino;
                $conta->save();

                $mensagem_vo = new MensagemVO('sucesso', 'A conta do inquilino foi alterada com sucesso');
                $mensagem = $mensagem_vo->getJson();

            }
            
            return view('app.cadastro-conta-inquilino', compact('titulo', 'conta', 'mensagem', 'contas_imovel'));
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', $th->getMessage());
        }
    }

    public function listarInquilinosSelectByImovel($idImovel){
        $inquilinos = InquilinosService::getListaInputInquilinos($idImovel);
        $inquilinos_json = [];
        foreach ($inquilinos as $inquilino) {
            $inquilinos_json[] = [
                'value' => $inquilino->id,
                'view' => $inquilino->nome
            ];
        }
        return $inquilinos_json;

    }

}

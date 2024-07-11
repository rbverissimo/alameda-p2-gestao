<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Models\BusinessObjects\InquilinoBO;
use App\Models\Contrato;
use App\Models\Inquilino;
use App\Models\InquilinoAluguel;
use App\Models\InquilinoConta;
use App\Models\InquilinoFatorDivisor;
use App\Models\InquilinoSaldo;
use App\Models\Pessoa;
use App\Services\ComprovantesService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Services\SituacaoFinanceiraService;
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

    public function painel_inquilino($id){

        $inquilino = InquilinosService::getInfoPainelInquilino($id);

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;
        $situacao_financeira_service = new SituacaoFinanceiraService();
        $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, ProjectUtils::getAnoMesSistemaSemMascara());
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

        $titulo = 'Detalhes do Inquilino: '.$inquilino->nome; 
        $appData_vo = new AppDataVO('detalhes_inquilino', [
            'nome_inquilino' => $inquilino->nome,
            'id_inquilino' => $inquilino->id
        ]);
        $appData = $appData_vo->getJson();

        return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'imoveis', 'salas', 'contrato', 'mensagem', 'appData'));

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
        // $this->detalharInquilino($id);
    }


    public function cadastrarInquilino(Request $request){

        try {

            $titulo = 'Cadastro de Inquilinos';
            $mensagem = null;
            $imoveis = ImoveisService::getImoveis();
            $salas = !empty($imoveis) ? ImoveisService::getSalaBy($imoveis[0]->id) : [];
            $contrato = null;

            
            if($request->isMethod('POST')){

                $regras_feedback = InquilinoBO::getRegrasValidacao();
                $request->validate($regras_feedback['regras'], $regras_feedback['feedback']);
                
                DB::transaction(function($closure) use ($request){
                    $pessoa = Pessoa::create([
                        "nome" => $request->input('nome'),
                        "cpf" => ProjectUtils::tirarMascara($request->input('cpf')),
                        "profissao" => $request->input('profissao'),
                        "telefone_celular" => ProjectUtils::tirarMascara($request->input('telefone-celular')),
                        "telefone_fixo" => ProjectUtils::tirarMascara($request->input('telefone-fixo')),
                        "telefone_trabalho" => ProjectUtils::tirarMascara($request->input('telefone-trabalho'))
                    ]);

                    
                    $inquilino = Inquilino::create([
                        'pessoacodigo' => DB::getPdo()->lastInsertId(),
                        'salacodigo' => $request->input('sala')
                    ]);
                    
                    $inicioValidade_aluguel = ProjectUtils::getReferenciaFromDate(ProjectUtils::normalizarData($request->input('data-assinatura'), Operacao::NORMALIZAR));
                    $fimValidade_aluguel = $request->input('data-expiracao') !== null ?
                        ProjectUtils::getReferenciaFromDate(ProjectUtils::normalizarData($request->input('data-expiracao'), Operacao::NORMALIZAR)) : null;
                    
                    $inquilino_id_inserido = DB::getPdo()->lastInsertId(); // snapshot desse momento    

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

            return view('app.cadastro-inquilino', compact('titulo', 'imoveis', 'salas', 'mensagem', 'contrato'));
        } catch (\Throwable $th) {
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

                $pessoa = $inquilino->getRelation('pessoa');
                $pessoa->nome = $request->input('nome');
                $pessoa->cpf = ProjectUtils::tirarMascara($request->input('cpf'));
                $pessoa->profissao = $request->input('profissao');
                $pessoa->telefone_celular = ProjectUtils::tirarMascara($request->input('telefone-celular'));
                $pessoa->telefone_fixo = ProjectUtils::tirarMascara($request->input('telefone-fixo'));
                $pessoa->telefone_trabalho = ProjectUtils::tirarMascara($request->input('telefone-trabalho'));

                $pessoa->save();

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
    
            return view('app.painel-situacao-financeira', compact('titulo', 'itens_carrossel', 'inquilino', 
                'situacao_financeira', 'referencia_situacao_financeira', 'comprovantes'));
        } catch (\InvalidArgumentException | Exception $e) {
            return redirect()->back()->with('erros', $e->getMessage());   
        }

    }

    public function consolidarSaldo($idInquilino){

        try {
            $mensagem_estado = "O saldo foi consolidado, porém sem alteração nos registros de saldos";
            $soma_todas_contas = InquilinosService::getTodasContasRegistradas($idInquilino);
            $soma_todos_comprovantes = InquilinosService::getSomaDeTodosOsComprovantesRegistrados($idInquilino);

            $creditos_json = $soma_todos_comprovantes['comprovantes'];
            $debitos_json = $soma_todas_contas['contas'];

            $saldo_atual = $soma_todos_comprovantes['soma'] - $soma_todas_contas['soma'];
            $saldo_atual_ja_consolidado = InquilinosService::getSaldoAtualBy($idInquilino);


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

            
            return response()->json(['saldo_atual' => $saldo_atual, 'creditos' => $creditos_json, 'debitos' => $debitos_json, 'mensagem' => $mensagem]);
        } catch (\Throwable $th) {

            $mensagem_vo = new MensagemVO('falha', $th->getMessage());
            $mensagem = $mensagem_vo->getJson();

            return response()->json(['mensagem' => $mensagem]);
        }


        
    }

}

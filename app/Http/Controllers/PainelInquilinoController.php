<?php

namespace App\Http\Controllers;

use App\Constants\Operacao;
use App\Models\Contrato;
use App\Models\ContratoModel;
use App\Models\Inquilino;
use App\Models\InquilinoAluguel;
use App\Models\Pessoa;
use App\Services\ComprovantesService;
use App\Services\ImoveisService;
use App\Services\InquilinosService;
use App\Services\SituacaoFinanceiraService;
use App\Services\PessoasService;
use App\Utils\ProjectUtils;
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

        $mensagemConfirmacaoModal = 'Consolidar o saldo do inquilino '.$inquilino->nome.' de acordo com as informações financeiras atuais?';

        return view('app.painel-inquilino', compact('inquilino', 'titulo', 'situacao_financeira', 'mensagemConfirmacaoModal'));
    }

    public function detalharInquilino($id){
        $inquilino = InquilinosService::getDetalhesInquilino($id);
        $inquilino->imovel = ImoveisService::getImovelBySala($inquilino->salacodigo);

        $titulo = 'Detalhes do Inquilino: '.$inquilino->nome; 
        $mensagem = null;

        $imoveis = ImoveisService::getListaImoveisSelect();
        $salas = ImoveisService::getSalaBy($inquilino->imovel);
        $contrato = InquilinosService::getContratoVigente($id);

        $dominio = 'detalhes_inquilino';
        $appData = [
            'nome_inquilino' => $inquilino->nome,
            'id_inquilino' => $inquilino->id
        ];

        return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'imoveis', 'salas', 'contrato', 'mensagem', 'dominio', 'appData'));

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
            $mensagem = '';
            $imoveis = ImoveisService::getImoveis();
            $salas = !empty($imoveis) ? ImoveisService::getSalaBy($imoveis[0]->id) : [];
            $contrato = null;

            
            if($request->isMethod('POST')){

                $regras = [
                    'data-assinatura' => 'required',
                    'valor-aluguel' => 'required',
                    'arquivo-contrato' => 'required|file',
                    'sala' => 'required|exists:salas,id',
                    'nome' => 'required',
                    'cpf' => 'required',
                    'telefone-celular' => 'required'
    
                ];
    
                $feedback = [
                    'sala.exists' => 'A sala informada é inválida. ',
                    'arquivo-contrato.file' => 'O contrato fornecido é inválido. ',

                    'required' => 'O :attribute é obrigatório.'
                ];
    
                $request->validate($regras, $feedback);
                
                DB::transaction(function($closure) use ($request){
                    $pessoa = Pessoa::create([
                        "nome" => $request->input('nome'),
                        "cpf" => ProjectUtils::removerMascara($request->input('cpf')),
                        "profissao" => $request->input('profissao'),
                        "telefone_celular" => ProjectUtils::tirarMascara($request->input('telefone-celular')),
                        "telefone_fixo" => ProjectUtils::tirarMascara($request->input('telefone-fixo')),
                        "telefone_trabalho" => ProjectUtils::tirarMascara($request->input('telefone-trabalho'))
                    ]);
    
                    $inquilino = Inquilino::create([
                        'pessoacodigo' => DB::getPdo()->lastInsertId(),
                        'salacodigo' => $request->input('sala')
                    ]);
    
                    $inicioValidade_aluguel = ProjectUtils::getReferenciaFromDate($request->input('data-assinatura'));
                    $fimValidade_aluguel = ProjectUtils::getReferenciaFromDate($request->input('data-expiracao'));
    
                    $inquilino_aluguel = InquilinoAluguel::create([
                        'inquilino' => DB::getPdo()->lastInsertId(), 
                        'valorAluguel' => ProjectUtils::retirarMascaraMoeda($request->input('valor-aluguel')),
                        'inicioValidade' => $inicioValidade_aluguel,
                        'fimValidade' => $fimValidade_aluguel
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
                        'dataExpiracao' => ProjectUtils::normalizarData($request->input('data-expiracao'), Operacao::SALVAR),
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
            //Buscar um objeto complexo de inquilino com seu contrato, aluguel e pessoa 
            

            return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'mensagem'));

        } catch (\Exception $e) {
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

}

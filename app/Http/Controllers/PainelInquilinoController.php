<?php

namespace App\Http\Controllers;

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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $titulo = 'Detalhes do Inquilino: '.$inquilino->nome; 
        $mensagem = null; 
        $mensagemConfirmacaoModal = 'Você tem certeza que deseja alterar a situação do inquilino '.$inquilino->nome.'?';

        $imoveis = ImoveisService::getListaImoveisSelect();
        $salas = [];
        $contrato = InquilinosService::getContratoVigente($id);

        return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'imoveis', 'salas', 'contrato', 'mensagem', 'mensagemConfirmacaoModal'));

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

                DB::transaction(function($request){
                    $pessoa = Pessoa::create([
                        "nome" => $request->input('nome'),
                        "cpf" => $request->input('cpf'),
                        "profissao" => $request->input('profissao'),
                        "telefone_celular" => $request->input('telefone-celular'),
                        "telefone_fixo" => $request->input('telefone-fixo'),
                        "telefone_trabalho" => $request->input('telefone-trabalho')
                    ]);
    
                    $id_pessoa = PessoasService::getIDMaximo();
    
                    $inquilino = Inquilino::create([
                        'pessoacodigo' => $id_pessoa,
                        'salacodigo' => $request->input('sala')
                    ]);
    
                    $id_inquilino = InquilinosService::getIDMaximo();
                    $inicioValidade_aluguel = ProjectUtils::getReferenciaFromDate($request->input('data-assinatura'));
                    $fimValidade_aluguel = ProjectUtils::getReferenciaFromDate($request->input('data-expiracao'));
    
                    $inquilino_aluguel = InquilinoAluguel::create([
                        'inquilino' => $id_inquilino, 
                        'valorAluguel' => $request->input('valor-aluguel'),
                        'inicioValidade' => $inicioValidade_aluguel,
                        'fimValidade' => $fimValidade_aluguel
                    ]);
    
    
                    $id_aluguel = InquilinosService::getIDMaximoAluguel();
    
                    $renovacao_automatica = $request->input('renovacao-automatica') === 'on' ? 'S' : 'N'; 
    
                    $contratoPath = null;
    
                    if($request->hasFile('contrato')){
                        $file = $request->file('contrato');
                        $fileName = $file->getClientOriginalName();
                        $contratoPath = $file->storeAs('contratos', $fileName);
                    }
                    $contrato = Contrato::create([
                        'aluguel' => $id_aluguel,
                        'dataAssinatura' => ProjectUtils::inverterDataParaSalvar($request->input('data-assinatura')),
                        'dataExpiracao' => ProjectUtils::inverterDataParaSalvar($request->input('data-expiracao')),
                        'renovacaoAutomatica' => $renovacao_automatica,
                        'contrato' => $contratoPath
                    ]);
                });



                $mensagem = 'Inquilino cadastrado com sucesso!';

            }

            return view('app.cadastro-inquilino', compact('titulo', 'imoveis', 'salas', 'mensagem', 'contrato'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("erros", "Não foi possível cadastrar um inquilino. Erro: ".$th->getMessage());
        }

    }

    public function editarInquilino(Request $request, $id){
        try {

            $titulo = $this->titulo;
            $inquilino = InquilinosService::getInquilinoBy($id);
            $inquilino_aluguel = InquilinosService::getAluguel($id);
            $fator_divisor = InquilinosService::getInquilinoFatorDivisorBy($id);
            $pessoa = PessoasService::getPessoaBy($inquilino->pessoacodigo);

            $pessoa->nome = $request->input('nome');
            $pessoa->cpf = $request->input('cpf');
            $pessoa->profissao = $request->input('profissao');
            $pessoa->telefone_celular = $request->input('telefone-celular');
            $pessoa->telefone_fixo = $request->input('telefone-fixo');
            $pessoa->telefone_trabalho = $request->input('telefone-trabalho');

            $pessoa->save();

            $inquilino_aluguel->valorAluguel = $request->input('valor-aluguel');

            $inquilino_aluguel->save();

            $fator_divisor->fatorDivisor = $request->input('fator-divisor');
            
            $fator_divisor->save();

            $inquilino->nome = $pessoa->nome;
            $inquilino->cpf = $pessoa->cpf;
            $inquilino->profissao = $pessoa->profissao;
            $inquilino->telefone_celular = $pessoa->telefone_celular;
            $inquilino->telefone_fixo = $pessoa->telefone_fixo;
            $inquilino->telefone_trabalho = $pessoa->telefone_trabalho;
            $inquilino->fatorDivisor = $fator_divisor->fatorDivisor;
            $inquilino->valorAluguel = $inquilino_aluguel->valorAluguel;


            $mensagem = 'sucesso';
            $mensagemConfirmacaoModal = 'Você tem certeza que deseja alterar a situação do inquilino '.$inquilino->nome.'?';

            return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'mensagem', 'mensagemConfirmacaoModal'));

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

<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\InquilinosService;
use App\Services\SituacaoFinanceiraService;
use App\Services\PessoasService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;

class PainelInquilinoController extends Controller
{
    private $titulo = 'Painel do Inquilino: '; 
    public function painel_inquilino($id){

        $inquilino = InquilinosService::getInfoPainelInquilino($id);

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;

        $situacao_financeira_service = new SituacaoFinanceiraService();
        $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, ProjectUtils::getAnoMesSistemaSemMascara());

        return view('app.painel-inquilino', compact('inquilino', 'titulo', 'situacao_financeira'));
    }

    public function detalharInquilino($id){
        $inquilino = InquilinosService::getDetalhesInquilino($id);
        $titulo = 'Detalhes do Inquilino: '.$inquilino->nome; 

        $mensagemConfirmacaoModal = 'Você tem certeza que deseja alterar a situação do inquilino '.$inquilino->nome.'?';

        return view('app.detalhes-inquilino', compact('titulo', 'inquilino', 'mensagemConfirmacaoModal'));

    }

    public function toggleSituacaoInquilino($id){
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

    public function editarInquilino(Request $request, $id){
        try {

            $titulo = $this->titulo;
            $inquilino = InquilinosService::getInquilinoBy($id);
            $fator_divisor = InquilinosService::getInquilinoFatorDivisorBy($id);
            $pessoa = PessoasService::getPessoaBy($inquilino->pessoacodigo);

            $pessoa->nome = $request->input('nome');
            $pessoa->cpf = $request->input('cpf');
            $pessoa->profissao = $request->input('profissao');
            $pessoa->telefone_celular = $request->input('telefone_celular');
            $pessoa->telefone_fixo = $request->input('telefone_fixo');
            $pessoa->telefone_trabalho = $request->input('telefone_trabalho');

            $pessoa->save();

            $inquilino->valorAluguel = $request->input('valor-aluguel');

            $inquilino->save();

            $fator_divisor->fatorDivisor = $request->input('fator-divisor');
            
            $fator_divisor->save();

        } catch (\Exception $e) {
            return redirect()->back()->with("mensagem", "Não foi possível alterar os dados do inquilino ");
        }        
    }

}

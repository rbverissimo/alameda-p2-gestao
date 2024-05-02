<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\InquilinosService;
use App\Services\SituacaoFinanceiraService;
use App\Utils\ProjectUtils;
use GuzzleHttp\Psr7\Request;
use PessoasService;

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
        
            return response()->json(['message' => 'Situação do inquilino alteradac com sucesso!', 'inquilino' => $inquilino]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update situacao', 'error' => $e->getMessage()], 500);
        }
        // $this->detalharInquilino($id);
    }

    public function editarInquilino(Request $request, $id){
        try {

            $titulo = $this->titulo;
            $inquilino = InquilinosService::getInquilinoBy($id);
            $fator_divisor = InquilinosService::getInquilinoFatorDivisorBy($id);
            $pessoa = PessoasService::getPessoaBy($inquilino->pessoacodigo);


        } catch (\Throwable $th) {
            //throw $th;
        }        
    }

}

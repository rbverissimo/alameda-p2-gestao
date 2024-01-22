<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\SituacaoFinanceiraService;
use App\Utils\ProjectUtils;

class PainelInquilinoController extends Controller
{
    public function painel_inquilino($id){

        $inquilino = Inquilino::select('pessoas.nome', 'inquilinos.id', 'salas.nomesala',
        'inquilinos.salacodigo', 'inquilinos.qtdePessoasFamilia', 'inquilinos.valorAluguel',
        'pessoas.telefone_celular')
        ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
        ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
        ->where('inquilinos.id', $id)
        ->first();

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;

        $situacao_financeira_service = new SituacaoFinanceiraService();
        $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, ProjectUtils::getAnoMesSistemaSemMascara());

        return view('app.painel-inquilino', compact('inquilino', 'titulo', 'situacao_financeira'));
    }
}

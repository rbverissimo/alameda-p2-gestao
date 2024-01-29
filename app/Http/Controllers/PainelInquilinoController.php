<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Services\InquilinosService;
use App\Services\SituacaoFinanceiraService;
use App\Utils\ProjectUtils;

class PainelInquilinoController extends Controller
{
    public function painel_inquilino($id){

        $inquilino = InquilinosService::getInfoPainelInquilino($id);

        $titulo = 'Painel do Inquilino: '.$inquilino->nome;

        $situacao_financeira_service = new SituacaoFinanceiraService();
        $situacao_financeira = $situacao_financeira_service->buscarSituacaoFinanceira($inquilino->id, ProjectUtils::getAnoMesSistemaSemMascara());

        return view('app.painel-inquilino', compact('inquilino', 'titulo', 'situacao_financeira'));
    }
}

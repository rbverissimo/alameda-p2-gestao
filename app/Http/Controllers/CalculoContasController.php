<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {

        $conta_imovel = new ContaImovel();
        $conta_imovel->salacodigo = 1;
        $conta_imovel->valor = $request->input('conta-luz-1');
        $conta_imovel->ano = $request->input('ano-referencia');
        $conta_imovel->mes = $request->input('mes-referencia');
        $conta_imovel->dataVencimento = $request->input('data-vencimento-conta-luz-1');
        $conta_imovel->referenciaConta = $request->input('referenciaConta-conta-luz-1');
        $conta_imovel->nrDocumento = $request->input('nr-documento-conta-luz-1');
        $conta_imovel->tipocodigo = 2;

        $conta_imovel->save();

        $c2 = new ContaImovel();
        $c2->salacodigo = 2;
        $c2->valor = $request->input('conta-luz-2');
        $c2->ano = $request->input('ano-referencia');
        $c2->mes = $request->input('mes-referencia');
        $c2->dataVencimento = $request->input('data-vencimento-conta-luz-2');
        $c2->referenciaConta = $request->input('referenciaConta-conta-luz-2');
        $c2->nrDocumento = $request->input('nr-documento-conta-luz-2');
        $c2->tipocodigo = 2;

        $conta_imovel->save();

        $c3 = new ContaImovel();
        $c3->salacodigo = 3;
        $c3->valor = $request->input('conta-luz-3');
        $c3->ano = $request->input('ano-referencia');
        $c3->mes = $request->input('mes-referencia');
        $c3->dataVencimento = $request->input('data-vencimento-conta-luz-3');
        $c3->referenciaConta = $request->input('referenciaConta-conta-luz-3');
        $c3->nrDocumento = $request->input('nr-documento-conta-luz-3');
        $c3->tipocodigo = 2;

        $conta_imovel->save();

        $c_agua = new ContaImovel();
        $c_agua->imovelcodigo = 1;
        $c_agua->valor = $request->input('conta-agua');
        $c_agua->ano = $request->input('ano-referencia');
        $c_agua->mes = $request->input('mes-referencia');
        $c_agua->dataVencimento = $request->input('data-vencimento-conta-agua');
        $c_agua->referenciaConta = $request->input('referenciaConta-conta-agua');
        $c_agua->nrDocumento = $request->input('nr-documento-conta-agua');
        $c_agua->tipocodigo = 1;

        $conta_imovel->save();



        return view('app.calculo-contas');
    }
}

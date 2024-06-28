<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use App\Models\Fornecedor;
use App\Services\ComprasService;
use App\Services\FornecedoresService;
use App\Services\ImoveisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComprasController extends Controller
{
    

    public function index(){

        $titulo = 'Painel de Compras';

        try {

            $compras = ComprasService::getDadosTabelaCompras();

            return view('app.painel-compras', compact('titulo', 'compras'));
            
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível acessar as compras '.$th->getMessage());
        }

    }


    public function cadastrar(){
        $titulo = 'Cadastrar nova compra';
        try {

            $formas_pagamento = ComprasService::getFormasPagamento();
            $imoveis = ImoveisService::getImoveis();

            return view('app.cadastro-compra', compact('titulo', 'formas_pagamento', 'imoveis'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível cadastrar a compras '.$th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\FormaPagamento;
use App\Models\Fornecedor;
use App\Services\ComprasService;
use App\Services\FornecedoresService;
use App\Services\ImoveisService;
use App\Utils\ProjectUtils;
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


    public function cadastrar(Request $request){
        $titulo = 'Cadastrar nova compra';
        try {

            $formas_pagamento = ComprasService::getSelectOptionsFormasPagamento();
            $imoveis = ImoveisService::getListaImoveisSelect();
            $fornecedores = [];
            $compra = '';

            if($request->isMethod('POST')){

                $nova_compra = new Compra();

                $cnpj_fornecedor = ProjectUtils::tirarMascara($request->input('cnpj-fornecedor'));

                $fornecedor = FornecedoresService::getFornecedorBy($cnpj_fornecedor);

                if($fornecedor){
                    $nova_compra->fornecedor = $fornecedor->id;
                } else {
                    FornecedoresService::getFornecedorDTO($fornecedor);
                }

                //Checar se o fornecedor já existe no banco
                //Se ele não existir, cadastra-lo
                //Se ele existir, extrair o ID do registro e anotar na compra

                $filePath = null; 

                if($request->hasFile('arquivo-nota')){
                    $file = $request->file('arquivo-nota');
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('notas', $fileName);
                    $nova_compra->arquivo_nova = $filePath;
                }

            }

            return view('app.cadastro-compra', compact('titulo', 'formas_pagamento', 'imoveis', 'compra', 'fornecedores'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível cadastrar a compra. Erro: '.$th->getMessage());
        }
    }

    public function editar(Request $request, $idCompra){
        $titulo = 'Editar compra ';
        try {

            $formas_pagamento = ComprasService::getSelectOptionsFormasPagamento();
            $imoveis = ImoveisService::getListaImoveisSelect();
            $fornecedores = FornecedoresService::getSelectOptionsFornecedores();
            $compra = ComprasService::getCompraBy($idCompra);



            return view('app.cadastro-compra', compact('titulo', 'formas_pagamento', 'imoveis', 'fornecedores', 'compra'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível editar a compra. Erro: '.$th->getMessage());
        }

    }

    public function deletar($idCompra){

    }
}

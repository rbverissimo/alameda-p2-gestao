<?php

namespace App\Http\Controllers;

use App\Constants\FormasPagamento;
use App\Constants\Operacao;
use App\Http\Dto\CompraDTOBuilder;
use App\Http\Dto\FornecedorDTOBuilder;
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

                $cnpj_fornecedor = ProjectUtils::tirarMascara($request->input('cnpj-fornecedor'));
                $fornecedor = FornecedoresService::getFornecedorBy($cnpj_fornecedor);

                $dataCompra = ProjectUtils::normalizarData($request->input('data-compra'), Operacao::SALVAR);
                $imovel = $request->input('imovel');
                $valorCompra = ProjectUtils::retirarMascaraMoeda($request->input('valor-compra')); 
                $tipoCompra = $request->input('tipo-compra');
                $formaPagamento = $request->input('forma-pagamento');

                if($formaPagamento === FormasPagamento::CREDITO){
                    $qtdeParcelas = $request->input('qtde-parcelas');
                }

                $nomeVendedor = $request->input('nome-vendedor');
                $garantia = $request->input('garantia') === 'on' ? 'S' : 'N';
                $qtdeDiasGarantia = $request->input('qtde-dias-garantia');
                $descricao = $request->input('descricao');

                $filePath = null; 
                if($request->hasFile('arquivo-nota')){
                    $file = $request->file('arquivo-nota');
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('notas', $fileName);
                    $arquivo_nota = $filePath;
                }

                $nrDocumentoNota = $request->input('nr-documento');

                $compra_dto = (new CompraDTOBuilder)
                    ->withDataCompra($dataCompra)
                    ->withValorCompra($valorCompra)
                    ->withImovelCompra($imovel)
                    ->withFormaPagamento($formaPagamento)
                    ->withQtdeParcelas($qtdeParcelas)
                    ->withNomeVendedor($nomeVendedor)
                    ->withNota($arquivo_nota)
                    ->withNrDocumentoNota($nrDocumentoNota)
                    ->withDescricao($descricao)
                    ->withGarantia($garantia)
                    ->withQtdeDiasGarantia($qtdeDiasGarantia)
                ->build();

                if($fornecedor){
                    $compra_dto->setIdFornecedor($fornecedor->id);
                } else {

                    $fornecedor_dto = (new FornecedorDTOBuilder)

                    ->build();

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

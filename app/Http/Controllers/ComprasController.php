<?php

namespace App\Http\Controllers;

use App\Constants\FormasPagamento;
use App\Constants\Operacao;
use App\Http\Dto\CompraDTOBuilder;
use App\Http\Dto\FornecedorDTOBuilder;
use App\Models\Compra;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Services\ComprasService;
use App\Services\FornecedoresService;
use App\Services\ImoveisService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            $mensagem = [];
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
                $qtdeParcelas = 0;
                if($formaPagamento === FormasPagamento::CREDITO){
                    $qtdeParcelas = $request->input('qtde-parcelas');
                }

                $nomeVendedor = $request->input('nome-vendedor');
                $garantia = $request->input('garantia') === 'on' ? 'S' : 'N';
                $qtdeDiasGarantia = $request->input('qtde-dias-garantia');
                $descricao = $request->input('descricao');

                $filePath = null; 
                $arquivo_nota = '';
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

                $fornecedor_dto = null;
                if($fornecedor){
                    $compra_dto->setIdFornecedor($fornecedor->id);


                } else {

                    $nome_fornecedor = $request->input('nome-fornecedor');
                    $telefone_fornecedor = ProjectUtils::tirarMascara($request->input('telefone-fornecedor'));
                    $cep_fornecedor = ProjectUtils::tirarMascara($request->input('cep'));
                    $logradouro_fornecedor = $request->input('logradouro');
                    $numero_endereco_fornecedor = $request->input('numero-endereco');
                    $cidade_fornecedor = $request->input('cidade');
                    $uf_fornecedor = $request->input('uf');
                    $bairro_fornecedor = $request->input('bairro');

                    $fornecedor_dto = (new FornecedorDTOBuilder)
                        ->withCnpjFornecedor($cnpj_fornecedor)
                        ->withNomeFornecedor($nome_fornecedor)
                        ->withTelefoneFornecedor($telefone_fornecedor)
                        ->withCepFornecedor($cep_fornecedor)
                        ->withCidadeFornecedor($cidade_fornecedor)
                        ->withUfFornecedor($uf_fornecedor)
                        ->withLogradouroFornecedor($logradouro_fornecedor)
                        ->withNumeroEnderecoFornecedor($numero_endereco_fornecedor)
                        ->withBairroFornecedor($bairro_fornecedor)
                    ->build();

                }

                DB::transaction(function($closure_dto) use ($compra_dto, $fornecedor_dto){

                    if(isset($fornecedor_dto)){

                        Endereco::create([
                            'cep' => $fornecedor_dto->getCepFornecedor(),
                            'logradouro' => $fornecedor_dto->getLogradouroFornecedor(),
                            'bairro' => $fornecedor_dto->getBairroFornecedor(),
                            'numero' => $fornecedor_dto->getNumeroEnderecoFornecedor(),
                            'uf' => $fornecedor_dto->getUfFornecedor(),
                            'cidade' => $fornecedor_dto->getCidadeFornecedor()
                        ]);

                        Fornecedor::create([
                            'nome_fornecedor' => $fornecedor_dto->getNomeFornecedor(),
                            'cnpj' => $fornecedor_dto->getCnpjFornecedor(),
                            'telefone' => $fornecedor_dto->getTelefoneFornecedor(),
                            'endereco' => DB::getPdo()->lastInsertId()
                        ]);

                    }

                    Compra::create([
                        'fornecedor' => isset($fornecedor_dto) ? DB::getPdo()->lastInsertId() : $compra_dto->getIdFornecedor(),
                        'imovel' => $compra_dto->getImovelCompra(), 
                        'dataCompra' => $compra_dto->getDataCompra(),
                        'valor' => $compra_dto->getValorCompra(),
                        'descricao' => $compra_dto->getDescricao(),
                        'nota' => $compra_dto->getNota(),
                        'nrDocumento' => $compra_dto->getNrDocumentoNota(),
                        'garantia' => $compra_dto->getGarantia(),
                        'qtdeDiasGarantia' => $compra_dto->getQtdeDiasGarantia(),
                        'nome_vendedor' => $compra_dto->getNomeVendedor(),
                        'forma_pagamento' => $compra_dto->getFormaPagamento(),
                        'qtdeParcelas' => $compra_dto->getQtdeParcelas() == 0 ? null : $compra_dto->getQtdeParcelas()
                    ]);

                });

                $mensagem = [
                    'status' => 'sucesso',
                    'mensagem' => 'A compra foi cadastrada com sucesso'
                ];

                

            }

            return view('app.cadastro-compra', compact('titulo', 'formas_pagamento', 'imoveis', 'compra', 'fornecedores', 'mensagem'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível cadastrar a compra. Erro: '.$th->getMessage());
        }
    }

    public function editar(Request $request, $idCompra){
        $titulo = 'Editar compra ';
        $mensagem = '';
        try {

            $formas_pagamento = ComprasService::getSelectOptionsFormasPagamento();
            $imoveis = ImoveisService::getListaImoveisSelect();
            $fornecedores = FornecedoresService::getSelectOptionsFornecedores();
            $compra = ComprasService::getCompraBy($idCompra);



            return view('app.cadastro-compra', compact('titulo', 'formas_pagamento', 'imoveis', 'fornecedores', 'compra', 'mensagem'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível editar a compra. Erro: '.$th->getMessage());
        }

    }

    public function deletar($idCompra){
        return Compra::where('id', $idCompra)->delete(); 
    }
}

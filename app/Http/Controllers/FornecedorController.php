<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\EnderecosService;
use App\Services\FornecedoresService;
use App\Utils\ProjectUtils;
use App\ValueObjects\MensagemVO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FornecedorController extends Controller
{


    public function index(){

        $titulo = 'Painel de fornecedores';

        try {
            $fornecedores = FornecedoresService::getFornecedores();

            return view('app.painel-fornecedores', compact('titulo','fornecedores'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível encontrar os dados dos fornecedores '.$th->getMessage());
        }
    }

    public function fornecedores(){

        try {
            $fornecedores = FornecedoresService::getFornecedores()->keyBy('cnpj');
    
            return response()->json(['search' => $fornecedores]);
        } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível buscar os fornecedores do banco de dados. Erro:'.$th->getMessage());
            $mensagem = $mensagem_vo->getJson();
            return response()->json($mensagem);
        }


    }

    public function editar(Request $request, $idFornecedor){
    
        try {
            $fornecedor = FornecedoresService::getFornecedorById($idFornecedor);
            $titulo = 'Editando fornecedor '.$fornecedor->nome_fornecedor;
            $mensagem = '';

            if($request->isMethod('PUT')){

                $regras = 
                [
                    'nome-fornecedor' => 'required|min:3',
                    'cnpj-fornecedor' => 'required|size:18',
                    'telefone-fornecedor' => 'required',
                    'cep' => 'required',
                    'logradouro' => 'required',
                    'numero-endereco' => 'required',
                    'bairro' => 'required',
                    'cidade' => 'required',
                    'uf' => 'required|size:2',
                ];
    
                $feedback = [
                    'nome-fornecedor.min' => 'O nome do fornecedor deve conter ao menos 3 caractéres. ',
                    'cnpj-fornecedor.size' => 'O CNPJ do fornecedor não está correto. ',
                    'uf.size' => 'A UF deve conter exatamente 2 caractéres',
    
                    'required' => 'O :attribute é obrigatório.',
                ];
    
                $request->validate($regras, $feedback);
    
                $fornecedor->nome_fornecedor = $request->input('nome-fornecedor');
                $fornecedor->telefone = ProjectUtils::tirarMascara($request->input('telefone-fornecedor'));
                $fornecedor->cnpj = ProjectUtils::tirarMascara($request->input('cnpj-fornecedor'));
    
                $endereco_fornecedor = EnderecosService::getEnderecoBy($fornecedor->endereco);
    
                $endereco_fornecedor->cep = ProjectUtils::tirarMascara($request->input('cep'));
                $endereco_fornecedor->logradouro = $request->input('logradouro');
                $endereco_fornecedor->numero = $request->input('numero-endereco');
                $endereco_fornecedor->bairro = $request->input('bairro');
                $endereco_fornecedor->cidade = $request->input('cidade');
                $endereco_fornecedor->uf = $request->input('uf');
    
                DB::transaction(function($closure) use($fornecedor, $endereco_fornecedor){
    
                    $fornecedor->save();
                    $endereco_fornecedor->save();
    
                });
    
    
                $mensagem_vo = new MensagemVO('sucesso', 'O registro de fornecedor foi modificado com sucesso!');
                $mensagem = $mensagem_vo->getJson();
                $fornecedor = FornecedoresService::getFornecedorById($idFornecedor);

                return view('app.cadastro-fornecedor', compact('titulo', 'fornecedor', 'mensagem'));

            }

            
        } catch (\Throwable $th) {
            if($th instanceof ValidationException){
                return back()->withErrors($th->validator->errors())->withInput($request->all()); 
            } else {
                redirect()->back()->with('erros', 'Não foi possível editar o fornecedor. Erro: '.$th->getMessage());
            }
        }

        return view('app.cadastro-fornecedor', compact('titulo', 'fornecedor', 'mensagem'));

    }

    public function deletar($idFornecedor){
        return Fornecedor::where('id', $idFornecedor)->delete();
    }
}

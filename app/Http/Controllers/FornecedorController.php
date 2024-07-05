<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\FornecedoresService;
use Illuminate\Http\Request;

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

        $fornecedores = FornecedoresService::getFornecedores()->keyBy('cnpj');

        return response()->json(['search' => $fornecedores]);

    }

    public function editar(Request $request, $idFornecedor){

        
        try {
            $fornecedor = FornecedoresService::getFornecedorById($idFornecedor);
            $titulo = 'Editando fornecedor '.$fornecedor->nome_fornecedor;
            $mensagem = '';

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


            
        } catch (\Throwable $th) {

        }

        return view('app.cadastro-fornecedor', compact('titulo', 'fornecedor', 'mensagem'));

    }

    public function deletar($idFornecedor){
        return Fornecedor::where('id', $idFornecedor)->delete();
    }
}

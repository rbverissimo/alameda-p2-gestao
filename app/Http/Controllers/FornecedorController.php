<?php

namespace App\Http\Controllers;

use App\Services\FornecedoresService;

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

    public function editar($idFornecedor){

        $fornecedor = FornecedoresService::getFornecedorById($idFornecedor);
        $titulo = 'Editando fornecedor '.$fornecedor->nome_fornecedor;
        $mensagem = '';

        return view('app.cadastro-fornecedor', compact('titulo', 'fornecedor', 'mensagem'));

    }
}

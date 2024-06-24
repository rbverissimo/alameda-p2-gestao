<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\FornecedoresService;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    

    public function index(){

        $titulo = 'Painel de Compras';

        try {

            return view('app.painel-compras', compact('titulo'));
            
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível acessar as compras '.$th->getMessage());
        }

    }


    public function cadastrar(){
        $titulo = 'Cadastrar nova compra';

        try {


            $input_autocomplete = FornecedoresService::getFornecedores()->keyBy('cnpj');
            
            return view('app.', compact('titulo', 'input_autocomplete'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível cadastrar a compras '.$th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Services\FornecedoresService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            
            return view('app.cadastro-compra', compact('titulo'));
        } catch (\Throwable $th) {
            redirect()->back()->with('erros', 'Não foi possível cadastrar a compras '.$th->getMessage());
        }
    }
}

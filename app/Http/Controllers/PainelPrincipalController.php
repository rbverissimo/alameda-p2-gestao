<?php

namespace App\Http\Controllers;

use App\Services\SituacaoFinanceiraService;
use Illuminate\Http\Request;

class PainelPrincipalController extends Controller
{
    public function index(){

        if(date('j') === '16'){
        }
        $situacao_financeira = new SituacaoFinanceiraService();
        $situacao_financeira->consolidarSaldo();
        
        $titulo = 'Painel Principal';
        $nome_usuario = $_SESSION['nome']; 

        return view('painel-principal', compact('titulo', 'nome_usuario'));
    }
}

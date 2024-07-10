<?php

namespace App\Http\Controllers;

class PainelPrincipalController extends Controller
{
    public function index(){
        
        $titulo = 'Painel Principal';
        $nome_usuario = $_SESSION['nome']; 

        return view('painel-principal', compact('titulo', 'nome_usuario'));
    }
}

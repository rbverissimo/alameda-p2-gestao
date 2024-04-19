<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelPrincipalController extends Controller
{
    public function index(){

        $titulo = 'Painel Principal';
        $nome_usuario = $_SESSION['nome']; 

        return view('painel-principal', compact('titulo', 'nome_usuario'));
    }
}

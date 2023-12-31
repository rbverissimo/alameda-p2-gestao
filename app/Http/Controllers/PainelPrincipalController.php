<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelPrincipalController extends Controller
{
    public function index(){

        $titulo = 'Painel Principal';

        return view('painel-principal', compact('titulo'));
    }
}

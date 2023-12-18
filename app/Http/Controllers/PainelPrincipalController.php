<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelPrincipalController extends Controller
{
    public function index(){
        return view('painel-principal');
    }
}

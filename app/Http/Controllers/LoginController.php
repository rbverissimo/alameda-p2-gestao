<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function index(Request $request){

        $titulo = 'Login do usuário';
        $codigo_erro = $request->get('erro');
        $erro = '';

        if($codigo_erro == 1){
            $erro = 'Login não realizado. Confira usuário e senha. ';
        }

        if($codigo_erro == 2){
            $erro = 'Não autorizado. Insira usuário e senha válidos. ';
        }

        return view('app.login', compact('titulo', 'erro'));
    }

    public function login(Request $request){

        

    }
}

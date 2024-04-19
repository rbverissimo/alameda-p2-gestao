<?php

namespace App\Http\Controllers;

use App\Models\User;
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


        $username = $request->get('username');
        $password = $request->get('password');

        $usuario = User::where('name', $username)
            ->where('passowrd', $password)
            ->get()
            ->first();

        
        if(isset($usuario->name)) {
                session_start();
                $_SESSION['nome'] = $usuario->name;
                $_SESSION['email'] = $usuario->email;
    
                return redirect()->route('painel-principal');
        } else { 
                return redirect()->route('login', ['erro' => 1]);
        }
        
    }
}

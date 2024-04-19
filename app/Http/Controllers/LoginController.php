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
        $password = $request->get('senha');

        $user = new User();

        $usuario = $user::where('name', $username)
            ->where('password', $password)
            ->get()
            ->first();
        
        if(isset($usuario->name)) {
                session_start();
                $_SESSION['nome'] = $usuario->name;
                $_SESSION['email'] = $usuario->email;

                print_r($_SESSION);
    
                return redirect()->route('painel-principal');
        } else { 
                return redirect()->route('login', ['erro' => 1]);
        } 
    }

    public function sair(){
        session_destroy();
        return redirect()->route('login');
    }
}

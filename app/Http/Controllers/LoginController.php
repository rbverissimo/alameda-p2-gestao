<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            session_set_cookie_params(86400);
            ini_set('session.gc_maxlifetime', 86400);
            session_start();


            session_regenerate_id(true);
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;


            //print_r($_SESSION);
    
            return redirect()->route('painel-principal');
        } else { 
            return redirect()->route('login', ['erro' => 1]);
        } 
    }

    public function sair(){
        session_regenerate_id(true);
        session_destroy();
        return redirect()->route('login');
    }
}

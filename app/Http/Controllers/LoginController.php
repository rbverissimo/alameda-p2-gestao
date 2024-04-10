<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function index(){

        $titulo = 'Login do usuário';

        return view('app.login', compact('titulo'));
    }

    public function authenticate(Request $request){

        $credentials = $request->validate(
            [
                'name' => ['required', 'name'],
                'password' => ['password']
            ]
        );

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('painel-principal');
        }

        return back()->withErrors([
            'name' => 'Usuário/Senha não encontrados.'
        ]);
    }
}

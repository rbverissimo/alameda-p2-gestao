<?php

namespace App\Http\Controllers;

use App\Models\LogErro;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class LogErroController extends Controller
{
    public function gravarErro(Request $request){
        $usuario = UsuarioService::getUsuarioLogado();
        $json = $request->input('json');
        $rota = $request->input('rota');
        $log = $request->input('log');

        LogErro::create([
            'usuario' => $usuario,
            'json' => $json,
            'rota' => $rota,
            'log' => $log
        ]);

        return response('', 200); 
    }
}

<?php

namespace App\Http\Controllers;

use App\ValueObjects\MensagemVO;
use Illuminate\Http\Request;

class IconesController extends Controller
{
    public function icone(Request $request){

        $iconName = $request->query('icone');
        try {
            $path = asset('icons/'.$iconName.'.svg');
            $data = file_get_contents($path);
            return response($data, 200);
        } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Houve uma falha ao buscar o ícone: '.$th->getMessage());
            $mensagem = $mensagem_vo->getJson();
            return response('', 500)->json($mensagem);
        }
    }
}

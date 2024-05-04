<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    /**
     * Esse método busca as informações contidas na Session usando uma chave para acessá-la
     * @param key, é a chave que será buscada na Session
     * @return response em json com o valor guardado pela Session na key passada ao método
     */
    public function getFlashedSessionData(Request $request){
        $chave = $request->input('chaveDataSession');

        if(Session::has($chave)){
            $data = Session::get($chave);
            return response()->json([$data]);
        }

        return response()->json([]);
    }
}

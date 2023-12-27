<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{
    public function index(Request $request){

        if($request->isMethod('post')){

            
        }

        return view('app.comprovantes-transferencia');
    }
}

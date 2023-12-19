<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprovantesTransferenciaController extends Controller
{
    public function index(){
        return view('app.comprovantes-transferencia');
    }
}

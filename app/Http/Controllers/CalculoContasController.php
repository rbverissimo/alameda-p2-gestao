<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoContasController extends Controller
{
    public function calculoContas(Request $request) {
        return view('app.calculo-contas');
    }
}

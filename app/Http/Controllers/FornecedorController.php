<?php

namespace App\Http\Controllers;

use App\Services\FornecedoresService;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function fornecedores(){

        $fornecedores = FornecedoresService::getFornecedores()->keyBy('cnpj');

        return response()->json(['fornecedores' => $fornecedores]);

    }
}

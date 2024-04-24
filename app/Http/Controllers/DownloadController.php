<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Esse método vai buscar o campo 'arquivo_conta' através do ID da ContaImovel
     */
    public function baixarArquivoContaBy($idConta){

        $path = ContaImovel::find($idConta)->arquivo_conta;
        $pathToFile = storage_path('app/'.$path);

        if(file_exists($pathToFile)){
            return response()->download($pathToFile);
        }

        abort(404);
    }
}

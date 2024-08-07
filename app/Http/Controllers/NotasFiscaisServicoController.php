<?php

namespace App\Http\Controllers;

use App\Services\PrestadorServicoService;
use Illuminate\Http\Request;

class NotasFiscaisServicoController extends Controller
{
    public function listarNotas($idPrestador){
        $nomePrestador = PrestadorServicoService::getNomePrestadorBy($idPrestador);
        $titulo = 'Cadastrando nota para o prestador '.$nomePrestador;
        $mensagem = null;
        try {
            return view('app.painel-notas-servicos', compact('titulo', 'mensagem', 'nomePrestador', 'idPrestador'));
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function cadastrarNota($idPrestador){
        $titulo = 'Cadastro de NFS-e';
        $mensagem = null;
        
        try {
            $nota = null;
            return view('app.cadastro-nota-servico', compact('titulo', 'mensagem', 'idPrestador', 'nota'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

}

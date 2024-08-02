<?php

namespace App\Http\Controllers;

use App\Services\TelefonesService;
use App\ValueObjects\MensagemVO;
use App\ValueObjects\SelectOptionVO;
use Error;
use Illuminate\Http\Request;

class TelefonesController extends Controller
{
    
    public function listarTipos(){
        try {

            $tipos = TelefonesService::getTipos();
            $options = [SelectOptionVO::getPrimeiroElementoVazio()];
            foreach ($tipos as $tipo) {
                $vo = new SelectOptionVO($tipo->codigo, $tipo->tipo);
                $options[] = $vo->getJson();
            }

            return response()->json(['options' => $options]);
        
        } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível buscar os tipos de telefones no servidor. Erro: '.$th->getMessage());
            $mensagem = $mensagem_vo->getJson();
            return response(['mensagem' => $mensagem], 500);
        }
    }
}

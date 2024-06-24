<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\Fornecedor;

class FornecedoresService {


    /**
     * Esse método busca todos os fornecedores registrados
     * nos imóvies de um determinado usuário
     */
    public static function getFornecedores(){
        $usuario = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($usuario);
        $fornecedores = Fornecedor::with('endereco')->whereHas('compras', function($query) use ($imoveis){
            $query->whereIn('imovel', $imoveis);
        })->get();
        return $fornecedores;
    }
}
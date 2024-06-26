<?php

namespace App\Services;

use App\Models\UsuarioImovel;
use Illuminate\Support\Facades\DB;

class ComprasService {


    public static function getDadosTabelaCompras(){

        $user = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($user);

        return DB::table('compras')->select('compras.dataCompra', 'compras.valor', 'fornecedores.nome_fornecedor')
            ->join('fornecedores', 'compras.fornecedor', '=', 'fornecedores.id')
            ->whereIn('compras.imovel', $imoveis)
            ->orderByDesc('compras.id')
            ->get();
    }

}
<?php

namespace App\Services;

use App\Models\FormaPagamento;
use App\Models\UsuarioImovel;
use Illuminate\Support\Facades\DB;

class ComprasService {


    /**
     * Esse método busca no banco de dados apenas
     * os dados necessários para renderizar uma tabela
     * de compras no front-end
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function getDadosTabelaCompras(){

        $user = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($user);

        return DB::table('compras')->select('compras.id', 'compras.dataCompra', 'compras.valor', 'fornecedores.nome_fornecedor')
            ->join('fornecedores', 'compras.fornecedor', '=', 'fornecedores.id')
            ->whereIn('compras.imovel', $imoveis)
            ->orderByDesc('compras.id')
            ->get();
    }

    public static function getFormasPagamento(){
        return FormaPagamento::select('codigo', 'descricao')->get();
    }

}
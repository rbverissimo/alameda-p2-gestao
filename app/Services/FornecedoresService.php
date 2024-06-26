<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedoresService {


    /**
     * Esse método busca todos os fornecedores registrados
     * nos imóvies de um determinado usuário
     */
    public static function getFornecedores(){
        $usuario = UsuarioService::getUsuarioLogado();
        $imoveis = UsuarioService::getImoveisBy($usuario);
        $fornecedores = Fornecedor::with('endereco')->whereHas('compra', function($query) use ($imoveis){
            $query->whereIn('imovel', $imoveis);
        })->get();
        return $fornecedores;
    }

    /**
     * Esse método procura pelos dados básicos de uma lista de fornecedores
     * no banco de dados para retorná-los ao front-end. O método busca
     * pelos primeiros 15 resultados paginados.
     * 
     */
    public static function getDadosFornecedoresTabela(){
        $imoveis = ImoveisService::getImoveisByUsuarioLogado();
        return DB::table('fornecedores')->select('fornecedores.cnpj', 'fornecedores.nome_fornecedor')
            ->whereIn('imovel', $imoveis)
            ->orderByDesc('fornecedores.id')
            ->paginate(15);
    }
}
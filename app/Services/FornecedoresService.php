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
     * Esse método busca apenas os principais atributos da tabela de fornecedores
     * com o intuito de entregá-los ao front-end da aplicação (normalmente para um Select-Options)
     * 
     */
    public static function getFornecedoresCnpjNome(){
        $imoveis = ImoveisService::getImoveisByUsuarioLogado();
        return Fornecedor::select('fornecedores.cnpj', 'fornecedores.nome_fornecedor')
             ->whereHas('compra', function($query) use ($imoveis){
                $query->whereIn('imovel', $imoveis);
            })->get();
    }

    public static function getSelectOptionsFornecedores(){
        $arr_db = FornecedoresService::getFornecedoresCnpjNome();
        $obj_vazio = new Fornecedor();
        $obj_vazio->cnpj = '';
        $obj_vazio->nome_fornecedor = '';
        return $arr_db->prepend($obj_vazio);
    }

    public static function getFornecedorBy($cnpj){
        return Fornecedor::where('cnpj', $cnpj)->first();
    }

    public static function getFornecedorById($id){
        return Fornecedor::find($id);
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
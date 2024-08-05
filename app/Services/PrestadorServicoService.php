<?php

namespace App\Services;

use App\Models\PrestadorServico;
use App\Models\TipoPrestador;
use Illuminate\Database\Eloquent\Builder;

class PrestadorServicoService {



    public static function getListaPainelPrestadores(){
       $imobiliarias = UsuarioService::getImobiliarias();

    }

    public static function getListaTiposPrestadores()
    {
        return TipoPrestador::all();
    }

    public static function getNomePrestadoresLike($nome, $registros = 10){
        $imobiliarias = UsuarioService::getImobiliarias();
        return PrestadorServico::select('id','nome', 'cpf', 'cnpj', 'telefone')
            ->join('prestadores_imobiliarias', 'prestador_id', 'prestadores_servicos.id')
            ->whereRaw('LOWER(nome) LIKE ?', [strtolower($nome).'%'])
            ->whereIn('prestadores_imobiliarias.imobiliaria_id', $imobiliarias)
            ->limit($registros)
            ->get();
    }

}
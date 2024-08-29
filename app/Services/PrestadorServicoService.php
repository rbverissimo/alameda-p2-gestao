<?php

namespace App\Services;

use App\Models\PrestadorServico;
use App\Models\TipoPrestador;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PrestadorServicoService {



    public static function getListaPainelPrestadores(){
       $imobiliarias = UsuarioService::getImobiliarias();
       return PrestadorServico::with('endereco', 'tipo', 'telefone', 'imobiliaria')
            ->join('prestadores_imobiliarias', 'prestadores_imobiliarias.prestador_id', 'prestadores_servicos.id')
            ->whereIn('prestadores_imobiliarias.imobiliaria_id', $imobiliarias)
            ->get();

    }

    public static function getPrestadorBy($idPrestador){
        return PrestadorServico::with('endereco', 'tipo', 'telefone', 'imobiliaria', 'servicos')
            ->find($idPrestador);
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

    public static function getNomePrestadorBy($idPrestador){
        return PrestadorServico::where('id', $idPrestador)->pluck('nome')->first();
    }

    public static function getIdPrestadorBy($nomePrestador){
        return PrestadorServico::where('nome','=', $nomePrestador)->pluck('id')->first();
    }

    public static function getImobiliarias($idPrestador){
        return DB::table('prestadores_imobiliarias as psi')
            ->select('psi.imobiliaria_id')
            ->where('prestador_id', $idPrestador)
            ->get();
    }

}
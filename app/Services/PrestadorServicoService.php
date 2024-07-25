<?php

namespace App\Services;

use App\Models\PrestadorServico;
use App\Models\TipoPrestador;
use Illuminate\Database\Eloquent\Builder;

class PrestadorServicoService {



    public static function getListaTiposPrestadores()
    {
        return TipoPrestador::all();
    }

    public static function getNomePrestadoresLike($nome, $registros = 10){
        $imobiliarias = UsuarioService::getImobiliarias();
        return PrestadorServico::select('pessoas.nome')
            ->join('pessoas', 'pessoas.id', 'prestadores_servicos.pessoa_id')
            ->join('prestadores_imobiliarias', 'prestador_id', 'prestadores_servicos.id')
            ->whereRaw('LOWER(pessoas.nome) LIKE ?', [strtolower($nome).'%'])
            ->whereIn('prestadores_imobiliarias.prestador_id', $imobiliarias)
            ->paginate($registros);
    }

}